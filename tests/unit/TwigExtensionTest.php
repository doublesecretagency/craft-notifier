<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\web\twig\Extension;
use doublesecretagency\notifier\web\twig\tokenparsers\SetDataTokenParser;
use doublesecretagency\notifier\web\twig\tokenparsers\SetMediaTokenParser;
use doublesecretagency\notifier\web\twig\tokenparsers\SetRecipientsTokenParser;
use doublesecretagency\notifier\web\twig\tokenparsers\SkipMessageTokenParser;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

/**
 * Structural tests for the Twig extension.
 *
 * The extension exposes a `notifier` global (so Twig templates can
 * reach the helper), two custom token parsers ({% skipMessage %} and
 * {% setRecipients %}), and two helper functions for the CP.
 *
 * The token-parser instantiation requires Twig autoloading but no
 * Craft container, these tests therefore instantiate the extension
 * directly and call getTokenParsers() / getFunctions() to verify
 * registration.
 */
class TwigExtensionTest extends TestCase
{
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $this->reflection = new ReflectionClass(Extension::class);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testExtendsTwigAbstractExtension(): void
    {
        $this->assertTrue($this->reflection->isSubclassOf(AbstractExtension::class));
    }

    public function testImplementsGlobalsInterface(): void
    {
        // GlobalsInterface is what makes getGlobals() actually run inside
        // Twig, without it, registered globals are silently ignored.
        $this->assertTrue($this->reflection->implementsInterface(GlobalsInterface::class));
    }

    // ========================================================================= //
    // Token parser registration
    // ========================================================================= //

    public function testRegistersAllTokenParsers(): void
    {
        $extension = new Extension();
        $parsers = $extension->getTokenParsers();

        $this->assertCount(4, $parsers);

        $parserClasses = array_map('get_class', $parsers);
        $this->assertContains(SkipMessageTokenParser::class, $parserClasses);
        $this->assertContains(SetDataTokenParser::class, $parserClasses);
        $this->assertContains(SetMediaTokenParser::class, $parserClasses);
        $this->assertContains(SetRecipientsTokenParser::class, $parserClasses);
    }

    // ========================================================================= //
    // Function registration
    // ========================================================================= //

    public function testRegistersAllCpHelperFunctions(): void
    {
        // Helper functions consumed by the notification edit screen when
        // populating the Sites, Sections, Volumes, and User Groups checkboxes.
        $extension = new Extension();
        $functions = $extension->getFunctions();

        $functionNames = array_map(
            static fn($fn) => $fn->getName(),
            $functions
        );

        $this->assertContains('availableSiteGroupsAndSites', $functionNames);
        $this->assertContains('availableSectionAndEntryTypes', $functionNames);
        $this->assertContains('availableVolumes', $functionNames);
        $this->assertContains('availableUserGroups', $functionNames);
    }

    public function testFunctionMethodsExist(): void
    {
        // The TwigFunction objects point at instance methods, those methods
        // must be present and public.
        $this->assertTrue($this->reflection->hasMethod('availableSiteGroupsAndSites'));
        $this->assertTrue(
            $this->reflection->getMethod('availableSiteGroupsAndSites')->isPublic()
        );

        $this->assertTrue($this->reflection->hasMethod('availableSectionAndEntryTypes'));
        $this->assertTrue(
            $this->reflection->getMethod('availableSectionAndEntryTypes')->isPublic()
        );

        $this->assertTrue($this->reflection->hasMethod('availableVolumes'));
        $this->assertTrue(
            $this->reflection->getMethod('availableVolumes')->isPublic()
        );

        $this->assertTrue($this->reflection->hasMethod('availableUserGroups'));
        $this->assertTrue(
            $this->reflection->getMethod('availableUserGroups')->isPublic()
        );
    }

    // ========================================================================= //
    // Globals
    // ========================================================================= //

    public function testRegistersGlobalsWithoutBootingCraft(): void
    {
        // We don't call getGlobals() (it reaches into Craft's fields service)
        // but verify the method exists, is public, and the source explicitly
        // exposes the `notifier` and `notificationOptions` globals.
        $this->assertTrue($this->reflection->hasMethod('getGlobals'));
        $this->assertTrue(
            $this->reflection->getMethod('getGlobals')->isPublic()
        );

        $path = $this->reflection->getFileName();
        $source = file_get_contents($path);
        $this->assertStringContainsString("'notifier'", $source);
        $this->assertStringContainsString("'notificationOptions'", $source);
    }

    public function testGlobalsExposeAllSeededOptionLists(): void
    {
        // Each option list the CP edit form expects to reach via
        // notificationOptions.* must be present.
        $path = $this->reflection->getFileName();
        $source = file_get_contents($path);

        $this->assertStringContainsString("'eventType'", $source);
        $this->assertStringContainsString("'allEvents'", $source);
        $this->assertStringContainsString("'messageType'", $source);
        $this->assertStringContainsString("'recipientsType'", $source);
        $this->assertStringContainsString("'flashType'", $source);
    }

    public function testRegistersTemplatingTipGlobal(): void
    {
        // The templatingTip sidenote must be a Twig global, not a {% set %} that
        // only lives in the full-page editor's _edit/index.twig wrapper. The
        // slideout renders each tab through the *FieldLayoutElement::formHtml()
        // classes, which never run that wrapper. When templatingTip was only set
        // in the wrapper, double-clicking a notification crashed the slideout with
        // "Variable templatingTip does not exist" (the event, message, and
        // recipients leaf templates all reference it). Registering it as a global
        // keeps it in scope for every render path. Guards against that regression.
        $path = $this->reflection->getFileName();
        $source = file_get_contents($path);

        $this->assertStringContainsString("'templatingTip'", $source);
    }

    // ========================================================================= //
    // Tier 2 filter-source helpers
    // ========================================================================= //

    /**
     * @return string[][]
     */
    public static function tier2HelperProvider(): array
    {
        return [
            ['availableProductTypes'],
            ['availableDigitalProductTypes'],
            ['availableCalendars'],
        ];
    }

    /**
     * @dataProvider tier2HelperProvider
     */
    public function testTier2HelperIsPublic(string $method): void
    {
        // Each Tier 2 category needs its own filter-source helper exposed to
        // Twig. The CP filter-axis partials call these to build their
        // checkbox lists; missing helpers would render an empty filter UI.
        $this->assertTrue($this->reflection->hasMethod($method));
        $this->assertTrue($this->reflection->getMethod($method)->isPublic());
        $this->assertSame('array', (string) $this->reflection->getMethod($method)->getReturnType());
    }

    public function testTier2HelpersGuardOnPluginPresence(): void
    {
        // Each plugin-bridged helper must guard on plugin presence so installs
        // without the source plugin return an empty array rather than fatal. The
        // guard is centralized in _pluginInstalled($class, $handle), which checks
        // class_exists($class) AND that the plugin has a live booted instance.
        $path = $this->reflection->getFileName();
        $source = file_get_contents($path);

        $this->assertStringContainsString("_pluginInstalled('craft\\\\commerce\\\\Plugin', 'commerce')", $source);
        $this->assertStringContainsString("_pluginInstalled('craft\\\\digitalproducts\\\\Plugin', 'digital-products')", $source);
        $this->assertStringContainsString("_pluginInstalled('Solspace\\\\Calendar\\\\Calendar', 'calendar')", $source);
    }

    public function testTier2HelpersRegisteredAsTwigFunctions(): void
    {
        // The new helpers must be exposed via getFunctions() so Twig
        // templates can call availableProductTypes() / etc.
        $path = $this->reflection->getFileName();
        $source = file_get_contents($path);

        $this->assertStringContainsString("'availableProductTypes'", $source);
        $this->assertStringContainsString("'availableDigitalProductTypes'", $source);
        $this->assertStringContainsString("'availableCalendars'", $source);
    }

    public function testGlobalsGuardTier2CategoriesOnPluginPresence(): void
    {
        // getGlobals() must unset each Tier 2 category from eventTypes and
        // allEvents when the source plugin is absent, otherwise the CP would
        // surface a non-functional dropdown option.
        $path = $this->reflection->getFileName();
        $source = file_get_contents($path);

        $this->assertStringContainsString("_pluginInstalled('craft\\\\commerce\\\\elements\\\\Product', 'commerce')", $source);
        $this->assertStringContainsString("_pluginInstalled('craft\\\\digitalproducts\\\\elements\\\\Product', 'digital-products')", $source);
        $this->assertStringContainsString("_pluginInstalled('Solspace\\\\Calendar\\\\Elements\\\\Event', 'calendar')", $source);
        $this->assertStringContainsString("unset(\$eventTypes['craft-commerce-products']", $source);
        $this->assertStringContainsString("unset(\$eventTypes['solspace-calendar-events']", $source);
    }
}
