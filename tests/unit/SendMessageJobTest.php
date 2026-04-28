<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\queue\BaseJob;
use doublesecretagency\notifier\base\EnvelopeInterface;
use doublesecretagency\notifier\jobs\SendMessage;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionNamedType;

/**
 * Structural tests for the SendMessage queue job.
 *
 * SendMessage is the queue wrapper around an EnvelopeInterface. The job
 * carries a single `envelope` property and delegates execute() to that
 * envelope's send() method. The defaultDescription() reads jobInfo so
 * the queue UI can label the job meaningfully.
 */
class SendMessageJobTest extends TestCase
{
    private string $jobSource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/jobs/SendMessage.php';
        $this->assertTrue(file_exists($path), "SendMessage.php should exist at: $path");
        $this->jobSource = file_get_contents($path);
        $this->reflection = new ReflectionClass(SendMessage::class);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testExtendsCraftBaseJob(): void
    {
        $this->assertTrue($this->reflection->isSubclassOf(BaseJob::class));
    }

    public function testHasEnvelopeProperty(): void
    {
        // The single piece of state the job carries.
        $this->assertTrue($this->reflection->hasProperty('envelope'));
    }

    public function testEnvelopePropertyIsTypedAsEnvelopeInterface(): void
    {
        // EnvelopeInterface is the base contract; concrete envelopes
        // (OutboundEmail / OutboundSms / etc.) all implement it.
        $type = $this->reflection->getProperty('envelope')->getType();
        $this->assertInstanceOf(ReflectionNamedType::class, $type);
        $this->assertSame(EnvelopeInterface::class, $type->getName());
    }

    // ========================================================================= //
    // Execute flow
    // ========================================================================= //

    public function testExecuteMethodExists(): void
    {
        $this->assertTrue($this->reflection->hasMethod('execute'));
        $this->assertTrue($this->reflection->getMethod('execute')->isPublic());
    }

    public function testExecuteDelegatesToEnvelopeSend(): void
    {
        // The queue worker simply asks the envelope to send itself.
        $this->assertStringContainsString(
            '$this->envelope->send()',
            $this->jobSource
        );
    }

    // ========================================================================= //
    // Description for queue UI
    // ========================================================================= //

    public function testDefaultDescriptionExists(): void
    {
        // Craft's queue UI calls defaultDescription() to label running jobs.
        $this->assertTrue($this->reflection->hasMethod('defaultDescription'));
        $this->assertTrue(
            $this->reflection->getMethod('defaultDescription')->isProtected()
        );
    }

    public function testDescriptionReadsFromEnvelopeJobInfo(): void
    {
        // The description interpolates messageType / recipient from the
        // envelope's jobInfo array — so the queue worker UI shows
        // "Sending an email to Jane Doe" rather than just "SendMessage job."
        $this->assertStringContainsString(
            "\$this->envelope->jobInfo['messageType']",
            $this->jobSource
        );
        $this->assertStringContainsString(
            "\$this->envelope->jobInfo['recipient']",
            $this->jobSource
        );
    }

    public function testDescriptionFallsBackToDefaultLabels(): void
    {
        // If jobInfo is missing values, the default labels match what
        // BaseEnvelope seeds.
        $this->assertStringContainsString(
            "'unspecified message'",
            $this->jobSource
        );
        $this->assertStringContainsString(
            "'unknown recipient'",
            $this->jobSource
        );
    }
}
