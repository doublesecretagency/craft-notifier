<?php
namespace doublesecretagency\notifier\tests\unit;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionMethod;

/**
 * Source-level tests for the Craft 4 / Craft 5 compatibility helper.
 *
 * The helper is the single point of indirection for the seven API rename
 * sites where Craft 5 broke compatibility with Craft 4. It cannot be
 * exercised at runtime without Craft::$app, so the tests below verify its
 * shape via Reflection and its decision logic via regex over the source.
 */
class CompatHelperTest extends TestCase
{
    private string $compatPath;
    private string $compatSource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $this->compatPath = dirname(__DIR__, 2) . '/src/helpers/Compat.php';
        $this->assertTrue(file_exists($this->compatPath), "Compat.php should exist at: {$this->compatPath}");
        $this->compatSource = file_get_contents($this->compatPath);
        $this->reflection = new ReflectionClass(\doublesecretagency\notifier\helpers\Compat::class);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testIsAbstract(): void
    {
        // Compat is a static-only utility; instantiating it is a programming error
        $this->assertTrue($this->reflection->isAbstract());
    }

    public function testLivesInHelpersNamespace(): void
    {
        $this->assertSame(
            'doublesecretagency\notifier\helpers',
            $this->reflection->getNamespaceName()
        );
    }

    public function testCachesIsCraft5Detection(): void
    {
        // Repeated calls to isCraft5() must not re-run version_compare; the result
        // is fixed for the lifetime of the request and the cache keeps callers cheap
        $this->assertMatchesRegularExpression(
            '/private static \?bool \$_isCraft5/',
            $this->compatSource
        );
        $this->assertMatchesRegularExpression(
            '/static::\$_isCraft5 \?\?=/',
            $this->compatSource
        );
    }

    // ========================================================================= //
    // Public method surface
    // ========================================================================= //

    /**
     * @dataProvider publicMethodProvider
     */
    public function testExposesPublicStaticMethod(string $methodName, string $expectedReturnType): void
    {
        $this->assertTrue(
            $this->reflection->hasMethod($methodName),
            "Compat must expose {$methodName}()"
        );
        $method = $this->reflection->getMethod($methodName);
        $this->assertTrue($method->isPublic(), "{$methodName}() must be public");
        $this->assertTrue($method->isStatic(), "{$methodName}() must be static");
        $this->assertSame(
            $expectedReturnType,
            (string) $method->getReturnType(),
            "{$methodName}() must return {$expectedReturnType}"
        );
    }

    public static function publicMethodProvider(): array
    {
        return [
            'isCraft5'                    => ['isCraft5', 'bool'],
            'utilitiesEventName'          => ['utilitiesEventName', 'string'],
            'defineAttributeHtmlEventName' => ['defineAttributeHtmlEventName', 'string'],
            'metaSidebarMethodName'       => ['metaSidebarMethodName', 'string'],
        ];
    }

    // ========================================================================= //
    // Decision logic (regex over source)
    // ========================================================================= //

    public function testIsCraft5UsesVersionCompare(): void
    {
        // Detection must use Craft::$app->getVersion() against '5.0.0'; doing
        // anything cleverer (parsing constants, sniffing classes) invites drift
        $this->assertMatchesRegularExpression(
            '/version_compare\(\s*Craft::\$app->getVersion\(\),\s*[\'"]5\.0\.0[\'"]/',
            $this->compatSource
        );
    }

    public function testUtilitiesEventNameReturnsRawStrings(): void
    {
        // Raw string literals are deliberate — referencing the class constants
        // (Utilities::EVENT_REGISTER_UTILITIES vs EVENT_REGISTER_UTILITY_TYPES)
        // would be a fatal error on whichever Craft version doesn't define it
        $this->assertMatchesRegularExpression(
            "/'registerUtilities'.*'registerUtilityTypes'/s",
            $this->compatSource
        );
    }

    public function testDefineAttributeHtmlEventNameReturnsRawStrings(): void
    {
        $this->assertMatchesRegularExpression(
            "/'defineAttributeHtml'.*'setTableAttributeHtml'/s",
            $this->compatSource
        );
    }

    public function testMetaSidebarMethodNameReturnsRawStrings(): void
    {
        $this->assertMatchesRegularExpression(
            "/'metaSidebarTemplate'.*'sidebarTemplate'/s",
            $this->compatSource
        );
    }

    // ========================================================================= //
    // Call sites use the helper (not raw constants)
    // ========================================================================= //

    /**
     * @dataProvider helperCallSiteProvider
     */
    public function testCallSiteUsesCompatHelper(string $relativePath, string $expectedCall): void
    {
        $path = dirname(__DIR__, 2) . '/src/' . $relativePath;
        $this->assertTrue(file_exists($path), "Source file should exist at: $path");
        $source = file_get_contents($path);
        $this->assertStringContainsString(
            $expectedCall,
            $source,
            "{$relativePath} must reference {$expectedCall} so the bridge is in effect"
        );
    }

    public static function helperCallSiteProvider(): array
    {
        return [
            'NotifierPlugin utilities event'         => ['NotifierPlugin.php', 'Compat::utilitiesEventName()'],
            'NotifierPlugin attribute html event'    => ['NotifierPlugin.php', 'Compat::defineAttributeHtmlEventName()'],
            'Notification meta sidebar'              => ['elements/Notification.php', 'Compat::metaSidebarMethodName()'],
            'NotificationsController meta sidebar'   => ['controllers/NotificationsController.php', 'Compat::metaSidebarMethodName()'],
            'Twig Extension entries service branch'  => ['web/twig/Extension.php', 'Compat::isCraft5()'],
        ];
    }

    // ========================================================================= //
    // Dual-method override sites (no Compat needed; framework calls the right one)
    // ========================================================================= //

    public function testNotificationConditionImplementsBothHooks(): void
    {
        $path = dirname(__DIR__, 2) . '/src/elements/conditions/NotificationCondition.php';
        $source = file_get_contents($path);
        $this->assertMatchesRegularExpression('/protected function conditionRuleTypes\(\): array/', $source);
        $this->assertMatchesRegularExpression('/protected function selectableConditionRules\(\): array/', $source);
    }

    public function testNotificationLogImplementsBothIconHooks(): void
    {
        $path = dirname(__DIR__, 2) . '/src/utilities/NotificationLog.php';
        $source = file_get_contents($path);
        $this->assertMatchesRegularExpression('/public static function iconPath\(\): \?string/', $source);
        $this->assertMatchesRegularExpression('/public static function icon\(\): \?string/', $source);
    }
}
