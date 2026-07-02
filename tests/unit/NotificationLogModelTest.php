<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\models\NotificationLog;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionMethod;

/**
 * Pure-unit tests for the NotificationLog view-model.
 *
 * The actual persistence is delegated to a Log ActiveRecord (which needs
 * the database), so these tests verify state, the public surface of the
 * five log levels, and the shape of the envelope() helper which seeds
 * the queue UI message.
 */
class NotificationLogModelTest extends TestCase
{
    private string $logSource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/models/NotificationLog.php';
        $this->assertTrue(file_exists($path), "NotificationLog.php should exist at: $path");
        $this->logSource = file_get_contents($path);
        $this->reflection = new ReflectionClass(NotificationLog::class);
    }

    // ========================================================================= //
    // Property defaults
    // ========================================================================= //

    public function testDefaultProperties(): void
    {
        $log = new NotificationLog();

        $this->assertNull($log->notificationId);
        $this->assertNull($log->envelopeId);
    }

    public function testConstructorHydratesProperties(): void
    {
        $log = new NotificationLog([
            'notificationId' => 12,
            'envelopeId'     => 34,
        ]);

        $this->assertSame(12, $log->notificationId);
        $this->assertSame(34, $log->envelopeId);
    }

    // ========================================================================= //
    // Public log-level surface
    // ========================================================================= //

    /**
     * @return string[][]
     */
    public static function logLevelProvider(): array
    {
        return [
            ['success'],
            ['info'],
            ['warning'],
            ['error'],
        ];
    }

    /**
     * @dataProvider logLevelProvider
     */
    public function testLevelMethodExists(string $level): void
    {
        // All four user-facing severity levels must be public methods so
        // callers can write `$notification->log->error(...)` etc.
        $this->assertTrue($this->reflection->hasMethod($level));
        $method = $this->reflection->getMethod($level);
        $this->assertTrue($method->isPublic());
    }

    /**
     * @dataProvider logLevelProvider
     */
    public function testLevelMethodSignature(string $level): void
    {
        // (string $message, ?int $envelopeId = null, array $details = [])
        $method = $this->reflection->getMethod($level);
        $params = $method->getParameters();

        $this->assertCount(3, $params, "$level() should accept (message, envelopeId, details)");
        $this->assertSame('message', $params[0]->getName());
        $this->assertSame('envelopeId', $params[1]->getName());
        $this->assertSame('details', $params[2]->getName());
        // envelopeId and details have defaults; message is required.
        $this->assertFalse($params[0]->isOptional());
        $this->assertTrue($params[1]->isOptional());
        $this->assertTrue($params[2]->isOptional());
    }

    // ========================================================================= //
    // Envelope helper
    // ========================================================================= //

    public function testEnvelopeMethodExists(): void
    {
        // envelope() seeds the log row that ties subsequent log entries
        // to a specific outbound message, it must be public.
        $this->assertTrue($this->reflection->hasMethod('envelope'));
        $this->assertTrue($this->reflection->getMethod('envelope')->isPublic());
    }

    public function testEnvelopeMethodTakesJobInfoAndDetails(): void
    {
        $method = $this->reflection->getMethod('envelope');
        $params = $method->getParameters();

        $this->assertCount(2, $params);
        $this->assertSame('jobInfo', $params[0]->getName());
        $this->assertSame('details', $params[1]->getName());
    }

    public function testEnvelopeMessageReferencesJobInfoTokens(): void
    {
        // The seed log message must interpolate {messageType} and {recipient}
        // so the UI can render a human-readable label for the envelope.
        $this->assertStringContainsString('{messageType}', $this->logSource);
        $this->assertStringContainsString('{recipient}', $this->logSource);
    }

    // ========================================================================= //
    // Feed scan parent helper
    // ========================================================================= //

    public function testFeedScanMethodExists(): void
    {
        // feedScan() seeds the parent envelope that a failed feed scan's
        // warning nests under, so it must be public.
        $this->assertTrue($this->reflection->hasMethod('feedScan'));
        $this->assertTrue($this->reflection->getMethod('feedScan')->isPublic());
    }

    public function testFeedScanTakesFeedUrlAndReturnsNullableInt(): void
    {
        // feedScan(string $feedUrl): ?int - the returned id becomes the
        // envelopeId the fetch/parse warning is attached to.
        $method = $this->reflection->getMethod('feedScan');
        $params = $method->getParameters();

        $this->assertCount(1, $params);
        $this->assertSame('feedUrl', $params[0]->getName());
        $this->assertSame('string', (string) $params[0]->getType());

        $returnType = $method->getReturnType();
        $this->assertNotNull($returnType);
        $this->assertSame('int', $returnType->getName());
        $this->assertTrue($returnType->allowsNull());
    }

    public function testFeedScanCreatesEnvelopeParent(): void
    {
        // The scan message names the feed being scanned, and the row is
        // written as an 'envelope' parent so warnings can nest beneath it.
        $this->assertStringContainsString('Scanning feed {url}.', $this->logSource);
        $this->assertMatchesRegularExpression(
            "/feedScan[\s\S]*?_log\('envelope'/",
            $this->logSource
        );
    }

    // ========================================================================= //
    // Dispatch (run-level) parent helper
    // ========================================================================= //

    public function testDispatchEnvelopeMethodExists(): void
    {
        // dispatchEnvelope() seeds the run-level parent that a dispatch-wide
        // failure (Twig error, no recipients) nests under, so it must be public.
        $this->assertTrue($this->reflection->hasMethod('dispatchEnvelope'));
        $this->assertTrue($this->reflection->getMethod('dispatchEnvelope')->isPublic());
    }

    public function testDispatchEnvelopeTakesTitleAndReturnsNullableInt(): void
    {
        // dispatchEnvelope(string $title): ?int - the returned id becomes the
        // envelopeId the dispatch-wide failure warning/error is attached to.
        $method = $this->reflection->getMethod('dispatchEnvelope');
        $params = $method->getParameters();

        $this->assertCount(1, $params);
        $this->assertSame('title', $params[0]->getName());
        $this->assertSame('string', (string) $params[0]->getType());

        $returnType = $method->getReturnType();
        $this->assertNotNull($returnType);
        $this->assertSame('int', $returnType->getName());
        $this->assertTrue($returnType->allowsNull());
    }

    public function testDispatchEnvelopeCreatesEnvelopeParent(): void
    {
        // The message names the notification being sent, and the row is written
        // as an 'envelope' parent so dispatch-wide failures can nest beneath it.
        $this->assertStringContainsString('Sending "{title}".', $this->logSource);
        $this->assertMatchesRegularExpression(
            "/dispatchEnvelope[\s\S]*?_log\('envelope'/",
            $this->logSource
        );
    }

    // ========================================================================= //
    // Private writer
    // ========================================================================= //

    public function testInternalLogIsPrivate(): void
    {
        // The actual record-write goes through a single private writer,
        // so the public level methods stay thin.
        $this->assertTrue($this->reflection->hasMethod('_log'));
        $this->assertTrue($this->reflection->getMethod('_log')->isPrivate());
    }

    public function testInternalLogPersistsRecord(): void
    {
        // The private writer must instantiate a Log record and call save().
        $this->assertStringContainsString('new Log()', $this->logSource);
        $this->assertMatchesRegularExpression('/\$record->save\(false\)/', $this->logSource);
    }

    public function testDetailsAreJsonEncoded(): void
    {
        // Details are persisted as a JSON-encoded text column to round-trip
        // arbitrary structured payloads.
        $this->assertStringContainsString('Json::encode($details)', $this->logSource);
    }

    // ========================================================================= //
    // Logging disable check
    // ========================================================================= //

    public function testLogShortCircuitsWhenLoggingDisabled(): void
    {
        // _log() must read the loggingEnabled setting and bail before any
        // record is constructed when the user has turned logging off.
        $this->assertMatchesRegularExpression(
            '/private function _log[\s\S]*?loggingEnabled[\s\S]*?return null/',
            $this->logSource
        );
    }

    public function testEnvelopeShortCircuitsWhenLoggingDisabled(): void
    {
        // envelope() must also bail early when logging is disabled, without
        // this guard, _prune() would still run on every dispatch even though
        // there's nothing to prune toward.
        $this->assertMatchesRegularExpression(
            '/public function envelope[\s\S]*?loggingEnabled[\s\S]*?return null/',
            $this->logSource
        );
    }

    // ========================================================================= //
    // Pruning logic
    // ========================================================================= //

    public function testInternalPruneIsPrivate(): void
    {
        // Pruning is an internal concern of the log model, never called
        // directly from outside.
        $this->assertTrue($this->reflection->hasMethod('_prune'));
        $this->assertTrue($this->reflection->getMethod('_prune')->isPrivate());
    }

    public function testEnvelopeTriggersPrune(): void
    {
        // Pruning is wired to fire once per dispatch, at the start of each
        // new envelope. There is no cron, the per-envelope hook is the
        // entire enforcement mechanism.
        $this->assertMatchesRegularExpression(
            '/public function envelope[\s\S]*?\$this->_prune\(\)/',
            $this->logSource
        );
    }

    public function testPruneReadsBothRetentionCaps(): void
    {
        // Both cap settings must be consulted independently in _prune().
        $this->assertMatchesRegularExpression(
            '/_prune[\s\S]*?logRetentionDays/',
            $this->logSource
        );
        $this->assertMatchesRegularExpression(
            '/_prune[\s\S]*?logRetentionRecords/',
            $this->logSource
        );
    }

    public function testPruneDeletesEnvelopesAndChildrenTogether(): void
    {
        // Pruning must remove both the envelope rows AND every row whose
        // envelopeId points at them, otherwise child events get stranded
        // when their parent is deleted.
        $this->assertMatchesRegularExpression(
            "/_prune[\s\S]*?'id' => \\\$expiredEnvelopeIds[\s\S]*?'envelopeId' => \\\$expiredEnvelopeIds/",
            $this->logSource
        );
    }
}
