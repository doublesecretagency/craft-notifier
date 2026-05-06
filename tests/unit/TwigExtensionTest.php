<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\web\twig\Extension;
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
 * Craft container — these tests therefore instantiate the extension
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
        // Twig — without it, registered globals are silently ignored.
        $this->assertTrue($this->reflection->implementsInterface(GlobalsInterface::class));
    }

    // ========================================================================= //
    // Token parser registration
    // ========================================================================= //

    public function testRegistersBothTokenParsers(): void
    {
        $extension = new Extension();
        $parsers = $extension->getTokenParsers();

        $this->assertCount(2, $parsers);

        $parserClasses = array_map('get_class', $parsers);
        $this->assertContains(SkipMessageTokenParser::class, $parserClasses);
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
        // The TwigFunction objects point at instance methods — those methods
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
        // — but verify the method exists, is public, and the source explicitly
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
}
