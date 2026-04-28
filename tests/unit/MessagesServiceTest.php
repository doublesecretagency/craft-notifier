<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\base\Component;
use doublesecretagency\notifier\services\Messages;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the Messages service.
 *
 * Messages is the entry-point that EventEvents helpers call when an
 * underlying Yii event matches a configured Notification. It owns the
 * "build a Dispatch, filter it, configure it, send it" pipeline. Each
 * step in that pipeline is structurally verified here.
 */
class MessagesServiceTest extends TestCase
{
    private string $messagesSource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/services/Messages.php';
        $this->assertTrue(file_exists($path), "Messages.php should exist at: $path");
        $this->messagesSource = file_get_contents($path);
        $this->reflection = new ReflectionClass(Messages::class);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testExtendsComponent(): void
    {
        $this->assertTrue($this->reflection->isSubclassOf(Component::class));
    }

    // ========================================================================= //
    // Public surface
    // ========================================================================= //

    public function testHasSendMethod(): void
    {
        $this->assertTrue($this->reflection->hasMethod('send'));
        $this->assertTrue($this->reflection->getMethod('send')->isPublic());
    }

    public function testSendMethodSignature(): void
    {
        // send(Notification $notification, Event $event, array $data = [])
        $params = $this->reflection->getMethod('send')->getParameters();
        $this->assertCount(3, $params);
        $this->assertSame('notification', $params[0]->getName());
        $this->assertSame('event', $params[1]->getName());
        $this->assertSame('data', $params[2]->getName());
        // data has a default of []
        $this->assertTrue($params[2]->isOptional());
    }

    public function testHasSendAllMethod(): void
    {
        $this->assertTrue($this->reflection->hasMethod('sendAll'));
        $this->assertTrue($this->reflection->getMethod('sendAll')->isPublic());
    }

    public function testSendAllMethodSignature(): void
    {
        // sendAll(array $notifications, Event $event, array $data = [])
        $params = $this->reflection->getMethod('sendAll')->getParameters();
        $this->assertCount(3, $params);
        $this->assertSame('notifications', $params[0]->getName());
        $this->assertSame('event', $params[1]->getName());
        $this->assertSame('data', $params[2]->getName());
    }

    // ========================================================================= //
    // Pipeline integrity (source-level)
    // ========================================================================= //

    public function testSendBuildsADispatch(): void
    {
        // Messages::send must build a Dispatch model so the pipeline has
        // somewhere to hang transient state (collected dynamic recipients,
        // sandbox view, etc.).
        $this->assertStringContainsString('new Dispatch(', $this->messagesSource);
    }

    public function testSendBailsOnFailedEventFilter(): void
    {
        // After building Dispatch, it must short-circuit when
        // filterByEventType() returns false.
        $this->assertMatchesRegularExpression(
            '/if\s*\(\s*!\$dispatch->filterByEventType\(\)\s*\)/',
            $this->messagesSource
        );
    }

    public function testSendInvokesConfigureByMessageType(): void
    {
        // Then it asks Dispatch to compile the envelopes per the
        // notification's message type.
        $this->assertStringContainsString(
            '$dispatch->configureByMessageType()',
            $this->messagesSource
        );
    }

    public function testSendInvokesSendEnvelopes(): void
    {
        // Final step — actually dispatching the compiled envelopes (queue
        // or in-process, per Dispatch::useQueue).
        $this->assertStringContainsString(
            '$dispatch->sendEnvelopes()',
            $this->messagesSource
        );
    }

    public function testSendAllDelegatesToSend(): void
    {
        // sendAll is just a fan-out over send(); it should not have its own
        // pipeline logic.
        $this->assertStringContainsString(
            '$this->send($notification',
            $this->messagesSource
        );
    }
}
