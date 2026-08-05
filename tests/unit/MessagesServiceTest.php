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

    public function testSendTestBranchesOnFeedEventType(): void
    {
        // The feed branch pulls a random item from FeedRunner; the element
        // branch falls through to getRandomMatchingElement.
        $body = $this->_extractMethodBody('sendTest');
        $this->assertMatchesRegularExpression(
            "/'feed'\s*===\s*\\\$notification->eventType/",
            $body
        );
    }

    public function testSendTestCallsFeedRunnerGetRandomItem(): void
    {
        // The feed branch resolves Twig context via FeedRunner::getRandomItem
        $body = $this->_extractMethodBody('sendTest');
        $this->assertMatchesRegularExpression(
            '/feedRunner->getRandomItem\(\$notification\)/',
            $body
        );
    }

    public function testSendTestCallsGetRandomMatchingElement(): void
    {
        // Element-backed event types resolve a real element via the picker
        $body = $this->_extractMethodBody('sendTest');
        $this->assertMatchesRegularExpression(
            '/\$this->getRandomMatchingElement\(\$notification\)/',
            $body
        );
    }

    public function testSendTestThrowsPreflightOnFeedFailure(): void
    {
        // Feed branch throws TestPreflightException with a translated message
        // when no item can be resolved.
        $body = $this->_extractMethodBody('sendTest');
        $this->assertMatchesRegularExpression(
            '/throw\s+new\s+TestPreflightException\([\s\S]*?the feed could not be read or has no items/',
            $body
        );
    }

    public function testSendTestThrowsPreflightOnElementFailure(): void
    {
        // Element branch throws TestPreflightException when no candidate
        // satisfies the configured filters.
        $body = $this->_extractMethodBody('sendTest');
        $this->assertMatchesRegularExpression(
            '/throw\s+new\s+TestPreflightException\([\s\S]*?no element matches the configured filters/',
            $body
        );
    }

    public function testSendTestThreadsElementThroughEventSender(): void
    {
        // Recipient strategies that deref $event->sender directly should see
        // the chosen element, mirroring a real dispatch.
        $body = $this->_extractMethodBody('sendTest');
        $this->assertStringContainsString('$event->sender = $element', $body);
    }

    // ========================================================================= //
    // getRandomMatchingElement, picker for element-backed test sends
    // ========================================================================= //

    public function testHasGetRandomMatchingElementMethod(): void
    {
        $this->assertTrue($this->reflection->hasMethod('getRandomMatchingElement'));
        $this->assertTrue($this->reflection->getMethod('getRandomMatchingElement')->isPublic());
    }

    public function testGetRandomMatchingElementSignature(): void
    {
        // getRandomMatchingElement(Notification $notification): ?ElementInterface
        $method = $this->reflection->getMethod('getRandomMatchingElement');
        $params = $method->getParameters();
        $this->assertCount(1, $params);
        $this->assertSame('notification', $params[0]->getName());
        // Nullable ElementInterface return; null when no candidate passes.
        $returnType = $method->getReturnType();
        $this->assertNotNull($returnType);
        $this->assertSame('craft\\base\\ElementInterface', (string) $returnType->getName());
        $this->assertTrue($returnType->allowsNull());
    }

    public function testGetRandomMatchingElementAppliesElementCondition(): void
    {
        // The notification's saved element condition (if any) narrows the query
        // via the standard Craft modifyQuery API.
        $body = $this->_extractMethodBody('getRandomMatchingElement');
        $this->assertStringContainsString('$notification->getEventCondition()', $body);
        $this->assertStringContainsString('$condition->modifyQuery($query)', $body);
    }

    public function testGetRandomMatchingElementUsesRandOrdering(): void
    {
        // A small RAND()-ordered batch is fetched so candidate validation
        // can iterate until one passes filterByEventType.
        $body = $this->_extractMethodBody('getRandomMatchingElement');
        $this->assertMatchesRegularExpression(
            "/new\s+Expression\('RAND\(\)'\)/",
            $body
        );
        $this->assertMatchesRegularExpression(
            '/->limit\(\s*\d+\s*\)/',
            $body
        );
    }

    public function testGetRandomMatchingElementValidatesViaSharedDispatchFilter(): void
    {
        // The picker reuses Dispatch::filterByEventType as the source of truth
        // for "would this element have been notified about?" — same pattern
        // as getManualNotifications.
        $body = $this->_extractMethodBody('getRandomMatchingElement');
        $this->assertStringContainsString('new Dispatch(', $body);
        $this->assertStringContainsString('->filterByEventType()', $body);
    }

    // ========================================================================= //
    // _eventTypeToElementClass, event-type → element-class mapping
    // ========================================================================= //

    public function testHasEventTypeToElementClassHelper(): void
    {
        $this->assertTrue($this->reflection->hasMethod('_eventTypeToElementClass'));
        $this->assertTrue($this->reflection->getMethod('_eventTypeToElementClass')->isPrivate());
    }

    /**
     * @return string[][]
     */
    public static function coreEventTypeProvider(): array
    {
        // Core element types ship with Craft and never need a class_exists check.
        return [
            ['entries', 'Entry::class'],
            ['assets',  'Asset::class'],
            ['users',   'User::class'],
        ];
    }

    /**
     * @dataProvider coreEventTypeProvider
     */
    public function testEventTypeToElementClassMapsCoreType(string $eventType, string $classRef): void
    {
        $body = $this->_extractMethodBody('_eventTypeToElementClass');
        $this->assertMatchesRegularExpression(
            "/'{$eventType}'\s*=>\s*" . preg_quote($classRef, '/') . '/',
            $body
        );
    }

    /**
     * @return string[][]
     */
    public static function thirdPartyClassExistsGuardProvider(): array
    {
        // One class_exists guard per host plugin (DP's two element types
        // share a single DigitalProduct guard — they install together).
        return [
            ['Order'],          // Craft Commerce
            ['DigitalProduct'], // Digital Products
            ['CalendarEvent'],  // Solspace Calendar
        ];
    }

    /**
     * @dataProvider thirdPartyClassExistsGuardProvider
     */
    public function testEventTypeToElementClassGuardsOnClassExists(string $classAlias): void
    {
        $body = $this->_extractMethodBody('_eventTypeToElementClass');
        $this->assertMatchesRegularExpression(
            "/class_exists\({$classAlias}::class\)/",
            $body
        );
    }

    /**
     * @return string[][]
     */
    public static function thirdPartyEventTypeProvider(): array
    {
        // Event type → element class assignment, one per supported type.
        return [
            ['craft-commerce-orders',     'Order'],
            ['craft-commerce-products',   'CommerceProduct'],
            ['digital-products-products', 'DigitalProduct'],
            ['digital-products-licenses', 'License'],
            ['solspace-calendar-events',  'CalendarEvent'],
        ];
    }

    /**
     * @dataProvider thirdPartyEventTypeProvider
     */
    public function testEventTypeToElementClassMapsThirdPartyType(string $eventType, string $classAlias): void
    {
        $body = $this->_extractMethodBody('_eventTypeToElementClass');
        // Each event type → class mapping appears as an assignment, since
        // each line lives inside a class_exists() conditional block.
        $this->assertMatchesRegularExpression(
            "/\\\$map\['{$eventType}'\]\s*=\s*{$classAlias}::class/",
            $body
        );
    }

    // ========================================================================= //
    // _buildCandidateQuery, eventConfig → element-query restrictions
    // ========================================================================= //

    public function testHasBuildCandidateQueryHelper(): void
    {
        $this->assertTrue($this->reflection->hasMethod('_buildCandidateQuery'));
        $this->assertTrue($this->reflection->getMethod('_buildCandidateQuery')->isPrivate());
    }

    /**
     * @return string[][]
     */
    public static function candidateQueryRestrictionProvider(): array
    {
        // For each event type that has a query-level restriction, pin both
        // the case label and the eventConfig key → query method mapping.
        return [
            // event type, eventConfig key, query method
            ['entries',                   'sectionEntryTypes',   'andWhere'],
            ['entries',                   'sites',               'siteId'],
            ['assets',                    'volumes',             'volumeId'],
            ['users',                     'userGroups',          'groupId'],
            ['craft-commerce-products',   'productTypes',        'typeId'],
            ['digital-products-products', 'digitalProductTypes', 'typeId'],
        ];
    }

    /**
     * @dataProvider candidateQueryRestrictionProvider
     */
    public function testBuildCandidateQueryAppliesRestriction(string $eventType, string $configKey, string $queryMethod): void
    {
        $body = $this->_extractMethodBody('_buildCandidateQuery');
        // The case label appears
        $this->assertMatchesRegularExpression(
            "/case\s+'{$eventType}'\s*:/",
            $body
        );
        // The eventConfig key is read
        $this->assertMatchesRegularExpression(
            "/\\\$eventConfig\['{$configKey}'\]/",
            $body
        );
        // The query method is called with that key's value
        $this->assertMatchesRegularExpression(
            "/->{$queryMethod}\(/",
            $body
        );
    }

    public function testBuildCandidateQueryStripsUngroupedSentinelForUsers(): void
    {
        // Users' eventConfig allows a sentinel "0" for "Ungrouped"; the
        // picker drops it before applying groupId() so the query returns
        // the broader pool and filterByEventType filters it down.
        $body = $this->_extractMethodBody('_buildCandidateQuery');
        $this->assertMatchesRegularExpression(
            '/array_filter\(.*userGroups.*0\s*!==\s*\(int\)\s*\$g/',
            $body
        );
    }

    // ========================================================================= //
    // getManualNotifications, deciding which manual triggers apply
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
        // Whether a notification applies is decided by the live dispatch filter, not a duplicated
        // copy of the section / volume / group logic.
        $body = $this->_extractMethodBody('getManualNotifications');
        $this->assertStringContainsString('new Dispatch(', $body);
        $this->assertStringContainsString('filterByEventType()', $body);
    }

    public function testGetManualNotificationsUsesACheckOnlyDispatch(): void
    {
        // Reusing the live filter means inheriting its logging, so the check must flag
        // itself as check-only. Without it, every render of an element's action menu
        // or edit screen writes an envelope plus a warning for each misconfigured
        // manual notification, even though nothing is sent.
        $body = $this->_extractMethodBody('getManualNotifications');
        $this->assertStringContainsString("'checkOnly' => true,", $body);
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
