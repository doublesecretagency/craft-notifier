<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\base\ElementInterface;
use doublesecretagency\notifier\helpers\events\Originals;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the Originals registry.
 *
 * Originals is the central pre-save-snapshot store every save-event helper
 * writes into, and every has-changed condition rule reads back from. Drift
 * here (a renamed method, a different key shape, a missing reset) would
 * silently break has-changed evaluation across every element type the
 * plugin supports.
 */
class OriginalsTest extends TestCase
{
    private string $source;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/helpers/events/Originals.php';
        $this->assertTrue(file_exists($path), "Originals helper should exist at: $path");
        $this->source = file_get_contents($path);
        $this->reflection = new ReflectionClass(Originals::class);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testIsAbstract(): void
    {
        // Static-only registry; instantiating it would be a programming error.
        $this->assertTrue($this->reflection->isAbstract());
    }

    public function testLivesInHelpersEventsNamespace(): void
    {
        // Sibling of every *Events helper, the cross-references in those
        // helpers resolve via this namespace.
        $this->assertSame(
            'doublesecretagency\notifier\helpers\events',
            $this->reflection->getNamespaceName()
        );
    }

    // ========================================================================= //
    // Public API surface
    // ========================================================================= //

    public function testHasCaptureMethod(): void
    {
        // capture() is what every save-event helper's beforeSave handler calls.
        $this->assertTrue($this->reflection->hasMethod('capture'));
        $m = $this->reflection->getMethod('capture');
        $this->assertTrue($m->isPublic());
        $this->assertTrue($m->isStatic());
        $this->assertSame('void', (string) $m->getReturnType());

        $params = $m->getParameters();
        $this->assertCount(1, $params);
        $this->assertSame('original', $params[0]->getName());
        $this->assertSame(ElementInterface::class, (string) $params[0]->getType());
    }

    public function testHasGetMethod(): void
    {
        // get() is what the has-changed operators call - polymorphic lookup
        // by the post-save element's class + id + siteId.
        $this->assertTrue($this->reflection->hasMethod('get'));
        $m = $this->reflection->getMethod('get');
        $this->assertTrue($m->isPublic());
        $this->assertTrue($m->isStatic());
        $this->assertStringContainsString('ElementInterface', (string) $m->getReturnType());

        $params = $m->getParameters();
        $this->assertCount(1, $params);
        $this->assertSame('current', $params[0]->getName());
        $this->assertSame(ElementInterface::class, (string) $params[0]->getType());
    }

    public function testHasFindMethod(): void
    {
        // find() is the explicit (class, id, siteId) variant the helpers use
        // when they have those values handy and don't want to round-trip
        // through the post-save element instance.
        $this->assertTrue($this->reflection->hasMethod('find'));
        $m = $this->reflection->getMethod('find');
        $this->assertTrue($m->isPublic());
        $this->assertTrue($m->isStatic());

        $params = $m->getParameters();
        $this->assertCount(3, $params);
        $this->assertSame('class', $params[0]->getName());
        $this->assertSame('string', (string) $params[0]->getType());
        $this->assertSame('id', $params[1]->getName());
        $this->assertSame('int', (string) $params[1]->getType());
        $this->assertSame('siteId', $params[2]->getName());
        $this->assertTrue($params[2]->allowsNull());
    }

    public function testHasResetMethod(): void
    {
        // reset() exists for test isolation; not called in production code.
        $this->assertTrue($this->reflection->hasMethod('reset'));
        $m = $this->reflection->getMethod('reset');
        $this->assertTrue($m->isPublic());
        $this->assertTrue($m->isStatic());
        $this->assertSame('void', (string) $m->getReturnType());
        $this->assertCount(0, $m->getParameters());
    }

    // ========================================================================= //
    // Storage shape (source-level)
    // ========================================================================= //

    public function testStoreIsPrivateStaticArray(): void
    {
        // Per-request in-memory store. Private prevents external mutation;
        // static persists across all calls within the same request.
        $this->assertMatchesRegularExpression(
            '/private\s+static\s+array\s+\$_store\s*=\s*\[\];/',
            $this->source
        );
    }

    public function testCaptureKeysByClassIdSiteId(): void
    {
        // The three-tier index ([class][id][siteId]) is the bug-prevention
        // shape: per-site captures during multi-site propagation don't
        // clobber each other, and a Product and an Asset with the same id
        // are stored in separate buckets.
        $this->assertMatchesRegularExpression(
            '/static::\$_store\[\$original::class\]\[\$original->id\]\[\$siteId\]\s*=\s*\$original/',
            $this->source
        );
    }

    public function testCaptureGuardsAgainstMissingId(): void
    {
        // Brand-new elements that haven't been saved yet have no id; storing
        // them would key against null and be unrecoverable. Bail.
        $this->assertMatchesRegularExpression(
            '/if\s*\(!\$original->id\)\s*\{\s*return;\s*\}/',
            $this->source
        );
    }

    public function testGetReadsByCurrentElementsClassIdSiteId(): void
    {
        // Symmetric to capture: looks up by the post-save element's own
        // ::class + id + siteId so the has-changed operator's polymorphic
        // dispatch works for every element type.
        $this->assertMatchesRegularExpression(
            '/static::\$_store\[\$current::class\]\[\$current->id\]\[\$siteId\]/',
            $this->source
        );
    }

    public function testGetGuardsAgainstMissingId(): void
    {
        // A synthetic test element or a brand-new unsaved one has no id;
        // the lookup must early-bail rather than throw.
        $this->assertMatchesRegularExpression(
            '/if\s*\(empty\(\$current->id\)\)\s*\{\s*return\s+null;\s*\}/',
            $this->source
        );
    }

    public function testSiteIdDefaultsToZeroWhenAbsent(): void
    {
        // Non-site-aware elements (Users in particular) don't carry siteId.
        // The 0 fallback keeps the key shape uniform without leaking nulls
        // into the array key (which PHP would coerce inconsistently).
        $this->assertMatchesRegularExpression(
            '/\$siteId\s*=\s*\(\$original->siteId\s*\?\?\s*0\)/',
            $this->source
        );
        $this->assertMatchesRegularExpression(
            '/\$siteId\s*=\s*\(\$current->siteId\s*\?\?\s*0\)/',
            $this->source
        );
    }

    public function testResetEmptiesTheStore(): void
    {
        // The reset() body must zero the store, not just append-null;
        // tests rely on a clean slate between cases.
        $this->assertMatchesRegularExpression(
            '/static::\$_store\s*=\s*\[\];/',
            $this->source
        );
    }
}
