<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\events\CancelableEvent;
use craft\mail\Message;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\events\SendEmailEvent;
use doublesecretagency\notifier\models\OutboundEmail;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionNamedType;

/**
 * Shape tests for SendEmailEvent, the one event class shared by
 * OutboundEmail::EVENT_BEFORE_SEND and EVENT_AFTER_SEND (#35).
 *
 * Mirrors Yii's MailEvent: cancelable via `isValid` before sending, and
 * `isSuccessful` filled in after. Defaults are read via reflection rather
 * than `new`, per the suite's no-bootstrap protocol.
 */
class SendEmailEventTest extends TestCase
{
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $this->reflection = new ReflectionClass(SendEmailEvent::class);
    }

    public function testExtendsCancelableEvent(): void
    {
        // CancelableEvent supplies `isValid`, which the before-send event uses to cancel
        $this->assertTrue($this->reflection->isSubclassOf(CancelableEvent::class));
    }

    /**
     * @dataProvider propertyTypes
     */
    public function testDeclaresTypedNullableProperty(string $name, string $type): void
    {
        $this->assertTrue($this->reflection->hasProperty($name), "Missing property \${$name}");

        $property = $this->reflection->getProperty($name);
        $this->assertTrue($property->isPublic());

        $reflectionType = $property->getType();
        $this->assertInstanceOf(ReflectionNamedType::class, $reflectionType);
        $this->assertSame($type, $reflectionType->getName());
        $this->assertTrue($reflectionType->allowsNull());
    }

    public static function propertyTypes(): array
    {
        return [
            'message'      => ['message', Message::class],
            'notification' => ['notification', Notification::class],
            'envelope'     => ['envelope', OutboundEmail::class],
            'isSuccessful' => ['isSuccessful', 'bool'],
        ];
    }

    public function testIsSuccessfulDefaultsToNull(): void
    {
        // Null before sending; only the after-send event sets it
        $defaults = $this->reflection->getDefaultProperties();
        $this->assertArrayHasKey('isSuccessful', $defaults);
        $this->assertNull($defaults['isSuccessful']);
    }
}
