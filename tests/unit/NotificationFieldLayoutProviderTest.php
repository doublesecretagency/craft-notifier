<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\base\Chippable;
use craft\base\CpEditable;
use craft\base\FieldLayoutProviderInterface;
use craft\base\Iconic;
use doublesecretagency\notifier\models\NotificationFieldLayoutProvider;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the notification field layout provider.
 *
 * The provider is what turns a field's generic "Used by: 1 notification field
 * layout" text on the field edit screen into a clickable "Notifications" chip
 * linking back to the designer. Craft only renders the chip when the layout's
 * provider implements Chippable, so these tests pin the interface set + label +
 * link at the source level.
 */
class NotificationFieldLayoutProviderTest extends TestCase
{
    private string $source;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/models/NotificationFieldLayoutProvider.php';
        $this->assertTrue(file_exists($path), "Provider should exist at: $path");
        $this->source = file_get_contents($path);
        $this->reflection = new ReflectionClass(NotificationFieldLayoutProvider::class);
    }

    public function testImplementsChippableProviderAndCpEditable(): void
    {
        // Chippable is what makes Craft render the linked chip instead of the
        // generic fallback text; CpEditable supplies the link target.
        $this->assertTrue($this->reflection->implementsInterface(FieldLayoutProviderInterface::class));
        $this->assertTrue($this->reflection->implementsInterface(Chippable::class));
        $this->assertTrue($this->reflection->implementsInterface(CpEditable::class));
        // Iconic is what lets Craft render an icon alongside the chip label.
        $this->assertTrue($this->reflection->implementsInterface(Iconic::class));
    }

    public function testIconResolvesToThePluginMask(): void
    {
        // The chip icon is the plugin's monochrome mask, which tints to the chip color.
        $this->assertMatchesRegularExpression(
            "/getIcon[\s\S]*?getBasePath\(\)[\s\S]*?'icon-mask\.svg'/",
            $this->source
        );
    }

    public function testUiLabelIsNotifications(): void
    {
        // The chip label the user asked for.
        $this->assertMatchesRegularExpression(
            "/getUiLabel[\s\S]*?Craft::t\('notifier',\s*'Notifications'\)/",
            $this->source
        );
    }

    public function testCpEditUrlPointsAtTheDesigner(): void
    {
        // The chip links back to the Notification Fields designer.
        $this->assertMatchesRegularExpression(
            "/getCpEditUrl[\s\S]*?cpUrl\('settings\/plugins\/notifier\/fields'\)/",
            $this->source
        );
    }

    public function testFieldLayoutResolvesFromService(): void
    {
        $this->assertMatchesRegularExpression(
            '/getFieldLayout[\s\S]*?fieldLayouts->getLayout\(\)/',
            $this->source
        );
    }

    public function testElementAttachesProviderInDefineFieldLayouts(): void
    {
        // Craft re-fetches the type's layouts via fieldLayouts()/defineFieldLayouts()
        // to read the provider, so the element must attach it there.
        $elementSource = file_get_contents(dirname(__DIR__, 2) . '/src/elements/Notification.php');
        $this->assertMatchesRegularExpression(
            '/defineFieldLayouts[\s\S]*?new NotificationFieldLayoutProvider[\s\S]*?\$layout->provider\s*=/',
            $elementSource
        );
    }

    public function testProviderInstantiationIsGuardedForCraft4(): void
    {
        // The provider implements Chippable, CpEditable, and Iconic, which are all
        // Craft 5 only. On Craft 4 those interfaces don't exist, so merely autoloading
        // the class fatals with "Interface craft\base\Chippable not found". The only
        // instantiation must therefore sit behind a Compat::isCraft4() early return,
        // so the class is never referenced (and never autoloaded) on Craft 4. Pin the
        // ordering: the guard's early return must precede the `new` in defineFieldLayouts.
        $elementSource = file_get_contents(dirname(__DIR__, 2) . '/src/elements/Notification.php');
        $this->assertMatchesRegularExpression(
            '/defineFieldLayouts[\s\S]*?Compat::isCraft4\(\)[\s\S]*?return \$layouts;[\s\S]*?new NotificationFieldLayoutProvider/',
            $elementSource
        );
    }
}
