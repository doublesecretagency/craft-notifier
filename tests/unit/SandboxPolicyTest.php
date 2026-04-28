<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\models\Sandbox;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Pure-unit tests for the Sandbox security-policy selection.
 *
 * The Sandbox model picks between BLACKLIST/WHITELIST policies and
 * applies one of four ADD/REMOVE/REPLACE/DISABLE modes. The policy
 * lifecycle itself depends on `nystudio107/craft-twig-sandbox`, so
 * these tests verify the constants, the apply-mode dispatch, and the
 * Twig-type list — the parts that govern what the rest of the model
 * does without actually rendering Twig.
 */
class SandboxPolicyTest extends TestCase
{
    private string $sandboxSource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/models/Sandbox.php';
        $this->assertTrue(file_exists($path), "Sandbox.php should exist at: $path");
        $this->sandboxSource = file_get_contents($path);
        $this->reflection = new ReflectionClass(Sandbox::class);
    }

    // ========================================================================= //
    // Policy-list constants
    // ========================================================================= //

    public function testListConstantsExposeBlacklistAndWhitelist(): void
    {
        $this->assertSame('blacklist', Sandbox::BLACKLIST);
        $this->assertSame('whitelist', Sandbox::WHITELIST);
    }

    // ========================================================================= //
    // Apply-mode constants
    // ========================================================================= //

    public function testApplyModeConstants(): void
    {
        // The four documented apply modes, lowercase canonical strings.
        $this->assertSame('add',     Sandbox::ADD);
        $this->assertSame('remove',  Sandbox::REMOVE);
        $this->assertSame('replace', Sandbox::REPLACE);
        $this->assertSame('disable', Sandbox::DISABLE);
    }

    // ========================================================================= //
    // Twig type coverage
    // ========================================================================= //

    public function testTwigTypesCoverFiveCategories(): void
    {
        // The five categories the security policy can constrain. If a sixth
        // ever needs to exist (e.g. globals), this list must be updated and
        // an Add/Remove/Replace handler added too.
        //
        // Read the property default via reflection — instantiating Sandbox
        // boots BlacklistSecurityPolicy, which needs Craft's container.
        $defaults = $this->reflection->getDefaultProperties();
        $this->assertSame(
            ['tags', 'filters', 'functions', 'methods', 'properties'],
            $defaults['twigTypes']
        );
    }

    // ========================================================================= //
    // Apply-mode dispatch (source-level, since each mode applies via private
    // helpers that call into the security policy class)
    // ========================================================================= //

    public function testReplaceModeBranchesToReplaceHelper(): void
    {
        // Each mode branch must dispatch to its own helper for clarity and
        // so unit-level guards (these tests) can verify the wiring.
        $this->assertMatchesRegularExpression(
            '/case self::REPLACE:[\s\S]*?\$this->_replace/',
            $this->sandboxSource
        );
    }

    public function testRemoveModeBranchesToRemoveHelper(): void
    {
        $this->assertMatchesRegularExpression(
            '/case self::REMOVE:[\s\S]*?\$this->_remove/',
            $this->sandboxSource
        );
    }

    public function testAddIsTheDefaultBranch(): void
    {
        // ADD is the most permissive mode and must remain the default — any
        // unrecognized mode value should fall through to ADD rather than
        // silently disabling the sandbox.
        $this->assertMatchesRegularExpression(
            '/default:[\s\S]*?\$this->_add/',
            $this->sandboxSource
        );
    }

    public function testHasAddRemoveAndReplaceHelpers(): void
    {
        $this->assertTrue($this->reflection->hasMethod('_add'));
        $this->assertTrue($this->reflection->hasMethod('_remove'));
        $this->assertTrue($this->reflection->hasMethod('_replace'));

        // All three are private — they're internal helpers of the public init().
        $this->assertTrue($this->reflection->getMethod('_add')->isPrivate());
        $this->assertTrue($this->reflection->getMethod('_remove')->isPrivate());
        $this->assertTrue($this->reflection->getMethod('_replace')->isPrivate());
    }

    // ========================================================================= //
    // Whitelist vs blacklist selection
    // ========================================================================= //

    public function testWhitelistIsSelectedWhenConfigured(): void
    {
        // init() picks WhitelistSecurityPolicy when config['list'] === WHITELIST.
        $this->assertMatchesRegularExpression(
            '/self::WHITELIST\s*===\s*\(\$this->config\[\'list\'\][\s\S]*?new WhitelistSecurityPolicy/',
            $this->sandboxSource
        );
    }

    public function testBlacklistIsTheDefaultPolicy(): void
    {
        // The else branch instantiates the Blacklist policy — i.e. when
        // 'list' is unset or anything other than WHITELIST, blacklist wins.
        $this->assertMatchesRegularExpression(
            '/} else \{[\s\S]*?new BlacklistSecurityPolicy/',
            $this->sandboxSource
        );
    }
}
