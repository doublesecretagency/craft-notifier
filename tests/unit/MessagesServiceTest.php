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
        // Final step, actually dispatching the compiled envelopes (queue
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

    // ========================================================================= //
    // sendTest, manual operator-triggered dispatch
    // ========================================================================= //

    public function testHasSendTestMethod(): void
    {
        $this->assertTrue($this->reflection->hasMethod('sendTest'));
        $this->assertTrue($this->reflection->getMethod('sendTest')->isPublic());
    }

    public function testSendTestMethodSignature(): void
    {
        // sendTest(Notification $notification): Dispatch
        $method = $this->reflection->getMethod('sendTest');
        $params = $method->getParameters();
        $this->assertCount(1, $params);
        $this->assertSame('notification', $params[0]->getName());

        // Returns Dispatch so callers can introspect the compiled envelopes
        $returnType = $method->getReturnType();
        $this->assertNotNull($returnType);
        $this->assertSame(
            'doublesecretagency\\notifier\\models\\Dispatch',
            (string) $returnType
        );
    }

    public function testSendTestSkipsFilterByEventType(): void
    {
        // The whole point of the test path is to bypass event-type filters.
        // Isolate sendTest's body and assert no invocation of filterByEventType().
        // Match the call form `$dispatch->filterByEventType(` so an explanatory
        // comment containing the method name does not falsely fail the test.
        $body = $this->_extractMethodBody('sendTest');
        $this->assertDoesNotMatchRegularExpression(
            '/->filterByEventType\s*\(/',
            $body
        );
    }

    public function testSendTestFlagsDispatchAsTest(): void
    {
        // The Dispatch must be constructed with isTest = true so envelopes
        // get tagged in the log.
        $body = $this->_extractMethodBody('sendTest');
        $this->assertMatchesRegularExpression(
            "/'isTest'\s*=>\s*true/",
            $body
        );
    }

    public function testSendTestStillCompilesAndSendsEnvelopes(): void
    {
        // Skipping filters does not skip the rest of the pipeline; envelopes
        // still get compiled and dispatched.
        $body = $this->_extractMethodBody('sendTest');
        $this->assertStringContainsString('$dispatch->configureByMessageType()', $body);
        $this->assertStringContainsString('$dispatch->sendEnvelopes()', $body);
    }

    // ========================================================================= //
    // getManualNotifications, manual-trigger membership resolution
    // ========================================================================= //

    public function testHasGetManualNotificationsMethod(): void
    {
        $this->assertTrue($this->reflection->hasMethod('getManualNotifications'));
        $this->assertTrue($this->reflection->getMethod('getManualNotifications')->isPublic());
    }

    public function testGetManualNotificationsSignature(): void
    {
        // getManualNotifications(ElementInterface $element): array
        $method = $this->reflection->getMethod('getManualNotifications');
        $params = $method->getParameters();
        $this->assertCount(1, $params);
        $this->assertSame('element', $params[0]->getName());
        $this->assertSame('array', (string) $method->getReturnType());
    }

    public function testGetManualNotificationsQueriesManuallyTriggered(): void
    {
        // Only Notifications wired to the `manually-triggered` event qualify.
        $body = $this->_extractMethodBody('getManualNotifications');
        $this->assertStringContainsString("'manually-triggered'", $body);
    }

    public function testGetManualNotificationsReusesDispatchFilter(): void
    {
        // Membership is gated by the live dispatch filter, not a duplicated
        // copy of the section / volume / group logic.
        $body = $this->_extractMethodBody('getManualNotifications');
        $this->assertStringContainsString('new Dispatch(', $body);
        $this->assertStringContainsString('filterByEventType()', $body);
    }

    // ========================================================================= //

    /**
     * Extract the body of a named method from the cached source for source-level
     * regex assertions scoped to a single method.
     *
     * @param string $methodName
     * @return string
     */
    private function _extractMethodBody(string $methodName): string
    {
        $method = $this->reflection->getMethod($methodName);
        $start = $method->getStartLine();
        $end = $method->getEndLine();
        $lines = explode("\n", $this->messagesSource);
        return implode("\n", array_slice($lines, $start - 1, $end - $start + 1));
    }
}
