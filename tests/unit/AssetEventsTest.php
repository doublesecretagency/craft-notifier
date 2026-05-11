<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\elements\Asset;
use craft\events\ModelEvent;
use doublesecretagency\notifier\helpers\events\AssetEvents;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use yii\base\Event;

/**
 * Structural tests for the AssetEvents helper.
 *
 * Tier 1 (issue #2) added afterMove, afterDelete, and afterRestore alongside
 * the existing beforeSave / afterPropagate surface. afterPropagate and
 * afterMove both ride Asset::EVENT_AFTER_PROPAGATE; the firstSave + folder
 * /volume diff inside each handler splits "new upload" from "moved asset"
 * so the dispatch routes never cross.
 */
class AssetEventsTest extends TestCase
{
    private string $helperSource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/helpers/events/AssetEvents.php';
        $this->assertTrue(file_exists($path), "AssetEvents helper should exist at: $path");
        $this->helperSource = file_get_contents($path);
        $this->reflection = new ReflectionClass(AssetEvents::class);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testLivesInHelpersEventsNamespace(): void
    {
        $this->assertSame(
            'doublesecretagency\notifier\helpers\events',
            $this->reflection->getNamespaceName()
        );
    }

    public function testImportsAssetAndModelEvent(): void
    {
        $this->assertStringContainsString('use ' . Asset::class, $this->helperSource);
        $this->assertStringContainsString('use ' . ModelEvent::class, $this->helperSource);
    }

    // ========================================================================= //
    // Public method surface
    // ========================================================================= //

    /**
     * @return string[][]
     */
    public static function assetEventMethodProvider(): array
    {
        return [
            ['beforeSave',     ModelEvent::class],
            ['afterPropagate', ModelEvent::class],
            ['afterMove',      ModelEvent::class],
            ['afterUpdate',    ModelEvent::class],
            ['afterDelete',    Event::class],
            ['afterRestore',   Event::class],
        ];
    }

    /**
     * @dataProvider assetEventMethodProvider
     */
    public function testMethodIsPublicStaticVoid(string $method): void
    {
        $this->assertTrue($this->reflection->hasMethod($method));
        $reflectionMethod = $this->reflection->getMethod($method);
        $this->assertTrue($reflectionMethod->isPublic());
        $this->assertTrue($reflectionMethod->isStatic());
        $this->assertSame('void', (string) $reflectionMethod->getReturnType());
    }

    /**
     * @dataProvider assetEventMethodProvider
     */
    public function testMethodAcceptsExpectedEventType(string $method, string $eventClass): void
    {
        $params = $this->reflection->getMethod($method)->getParameters();
        $this->assertCount(1, $params);
        $this->assertSame('event', $params[0]->getName());
        $this->assertSame($eventClass, (string) $params[0]->getType());
    }

    // ========================================================================= //
    // beforeSave: original-asset capture
    // ========================================================================= //

    public function testBeforeSaveBypassesElementCacheWithIgnorePlaceholders(): void
    {
        $this->assertMatchesRegularExpression(
            '/beforeSave[\s\S]*?ignorePlaceholders\(\)/',
            $this->helperSource
        );
    }

    public function testBeforeSaveEagerLoadsFieldValues(): void
    {
        $this->assertMatchesRegularExpression(
            '/beforeSave[\s\S]*?getFieldValues\(\)/',
            $this->helperSource
        );
    }

    public function testBeforeSaveScopesQueryToAssetSite(): void
    {
        // Multi-site assets must be captured against the same site they were
        // saved against, otherwise the original would silently shift to the
        // primary site's content.
        $this->assertMatchesRegularExpression(
            '/beforeSave[\s\S]*?siteId\(\$asset->siteId\)/',
            $this->helperSource
        );
    }

    public function testOriginalsAreKeyedByAssetIdAndSiteId(): void
    {
        // beforeSave fires once per site during multi-site propagation. The
        // composite key prevents per-site captures from clobbering each other
        // before the dispatch handlers (afterPropagate, afterMove) read them.
        $this->assertMatchesRegularExpression(
            '/\$_originals\[\$asset->id\]\[\$asset->siteId\]\s*=\s*\$original/',
            $this->helperSource
        );
    }

    // ========================================================================= //
    // Propagate vs move: firstSave plus folder/volume diff
    // ========================================================================= //

    public function testAfterPropagateGuardsOnFirstSave(): void
    {
        // The new-upload dispatch must only fire when firstSave is true.
        // Without this guard, every asset save would also trigger the
        // "new file uploaded" notification.
        $this->assertMatchesRegularExpression(
            '/afterPropagate[\s\S]*?!\$asset->firstSave[\s\S]*?return/',
            $this->helperSource
        );
    }

    public function testAfterMoveGuardsOnNotFirstSave(): void
    {
        // Inverse firstSave guard: a brand-new upload is not a move.
        $this->assertMatchesRegularExpression(
            '/afterMove[\s\S]*?if\s*\(\s*\$asset->firstSave\s*\)[\s\S]*?return/',
            $this->helperSource
        );
    }

    public function testAfterUpdateGuardsOnNotFirstSave(): void
    {
        // Same firstSave guard as afterMove: a brand-new upload is not an update.
        $this->assertMatchesRegularExpression(
            '/afterUpdate[\s\S]*?if\s*\(\s*\$asset->firstSave\s*\)[\s\S]*?return/',
            $this->helperSource
        );
    }

    public function testAfterUpdateSkipsMoves(): void
    {
        // The symmetric inverse of afterMove's location-diff guard: when the
        // folder or volume changed, the save is a move and after-move owns it.
        // Pin the comparison so the two handlers stay mutually exclusive.
        $this->assertMatchesRegularExpression(
            '/afterUpdate[\s\S]*?folderId\s*!=\s*\$asset->folderId[\s\S]*?volumeId\s*!=\s*\$asset->volumeId[\s\S]*?return/',
            $this->helperSource
        );
    }

    public function testAfterUpdateBailsWhenNothingChanged(): void
    {
        // No-op saves (the user clicks Save without modifying anything) must
        // not fire the after-update trigger. The handler delegates to a private
        // change-detection helper; bail when that helper reports no changes.
        $this->assertMatchesRegularExpression(
            '/afterUpdate[\s\S]*?!\s*static::_assetHasChanges\(\$original,\s*\$asset\)[\s\S]*?return/',
            $this->helperSource
        );
    }

    public function testHasAssetHasChangesHelper(): void
    {
        // The change-detection helper must exist and be private+static.
        $this->assertTrue($this->reflection->hasMethod('_assetHasChanges'));
        $method = $this->reflection->getMethod('_assetHasChanges');
        $this->assertTrue($method->isPrivate());
        $this->assertTrue($method->isStatic());
    }

    public function testAssetHasChangesComparesNativeAttributes(): void
    {
        // The helper must compare key Asset attributes (filename, alt, focal
        // point, mime, size, dimensions, title). Without these comparisons a
        // rename or alt-text edit would silently fall under "no change" and
        // the after-update trigger would never fire for those edits.
        foreach (['title', 'filename', 'alt', 'focalPoint', 'kind', 'mimeType', 'size', 'width', 'height'] as $attr) {
            $this->assertStringContainsString("'{$attr}'", $this->helperSource);
        }
    }

    public function testAssetHasChangesComparesCustomFieldValues(): void
    {
        // Custom field values must be compared too so an edit to any custom
        // field on the Asset fires after-update. The comparison normalizes
        // field values via Field::serializeValue() so complex values (multi-
        // option dropdowns, table rows) compare reliably.
        $this->assertMatchesRegularExpression(
            '/_assetHasChanges[\s\S]*?getCustomFields\(\)[\s\S]*?serializeValue/',
            $this->helperSource
        );
    }

    public function testAfterMoveBailsWithoutCapturedOriginal(): void
    {
        // Move detection compares pre-save folder/volume against post-save
        // values. Without an original captured by beforeSave, the diff is
        // undefined; bail rather than dispatch a false positive.
        $this->assertMatchesRegularExpression(
            '/afterMove[\s\S]*?if\s*\(\s*!\$original\s*\)[\s\S]*?return/',
            $this->helperSource
        );
    }

    public function testAfterMoveComparesFolderAndVolumeIds(): void
    {
        // Both folder-level and volume-level moves must trigger the event.
        // The guard short-circuits only when neither changed.
        $this->assertMatchesRegularExpression(
            '/afterMove[\s\S]*?folderId[\s\S]*?volumeId/',
            $this->helperSource
        );
    }

    // ========================================================================= //
    // Notification query event filters (per-handler)
    // ========================================================================= //

    /**
     * @return string[][]
     */
    public static function notificationEventValueProvider(): array
    {
        return [
            ['afterPropagate', 'after-propagate'],
            ['afterMove',      'after-move'],
            ['afterUpdate',    'after-update'],
            ['afterDelete',    'after-delete'],
            ['afterRestore',   'after-restore'],
        ];
    }

    /**
     * @dataProvider notificationEventValueProvider
     */
    public function testHandlerQueriesNotificationsByEventValue(string $method, string $eventValue): void
    {
        // Each handler queries Notification rows whose `event` column matches
        // the dropdown value the user picked in the CP. These value strings
        // are persisted to the database, so renaming them is a breaking change.
        $this->assertMatchesRegularExpression(
            sprintf(
                '/%s[\s\S]*?\'event\'\s*=>\s*\'%s\'/',
                preg_quote($method, '/'),
                preg_quote($eventValue, '/')
            ),
            $this->helperSource
        );
    }

    /**
     * @dataProvider notificationEventValueProvider
     */
    public function testHandlerScopesQueryToAssetsEventType(string $method): void
    {
        // Every AssetEvents handler must scope the Notification query to the
        // 'assets' eventType so it cannot pick up dispatch rows belonging to
        // entries / users / commerce-orders.
        $this->assertMatchesRegularExpression(
            sprintf(
                '/%s[\s\S]*?\'eventType\'\s*=>\s*\'assets\'/',
                preg_quote($method, '/')
            ),
            $this->helperSource
        );
    }
}
