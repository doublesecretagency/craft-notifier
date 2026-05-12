<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\models\BaseEnvelope;
use doublesecretagency\notifier\models\OutboundEmail;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Pure-unit tests for the OutboundEmail envelope.
 *
 * The send() side effect (Craft's mailer) is exercised manually in the
 * sandbox; these tests cover envelope state, properties, defaults,
 * inheritance from BaseEnvelope, and the jobInfo shape that drives the
 * queue UI label.
 */
class OutboundEmailTest extends TestCase
{
    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testExtendsBaseEnvelope(): void
    {
        $reflection = new ReflectionClass(OutboundEmail::class);
        $this->assertTrue(
            $reflection->isSubclassOf(BaseEnvelope::class),
            'OutboundEmail should extend BaseEnvelope'
        );
    }

    public function testHasSendMethod(): void
    {
        // send() is the EnvelopeInterface contract method
        $reflection = new ReflectionClass(OutboundEmail::class);
        $this->assertTrue($reflection->hasMethod('send'));
        $this->assertTrue($reflection->getMethod('send')->isPublic());
    }

    // ========================================================================= //
    // Property defaults
    // ========================================================================= //

    public function testDefaultProperties(): void
    {
        $email = new OutboundEmail();

        // Recipient address defaults to null
        $this->assertNull($email->to);
        // Subject and body default to empty strings
        $this->assertSame('', $email->subject);
        $this->assertSame('', $email->body);
    }

    public function testInheritedEnvelopeIdDefaultsToNull(): void
    {
        $email = new OutboundEmail();
        $this->assertNull($email->envelopeId);
        $this->assertNull($email->notificationId);
    }

    public function testJobInfoHasDefaultPlaceholders(): void
    {
        // BaseEnvelope provides placeholder jobInfo so the queue UI never
        // renders a blank label even if the compiler skips configuring it.
        $email = new OutboundEmail();
        $this->assertArrayHasKey('messageType', $email->jobInfo);
        $this->assertArrayHasKey('recipient', $email->jobInfo);
    }

    // ========================================================================= //
    // Constructor hydration
    // ========================================================================= //

    public function testConstructorHydratesAllFields(): void
    {
        $email = new OutboundEmail([
            'notificationId' => 7,
            'envelopeId'     => 42,
            'to'             => 'jane@example.com',
            'subject'        => 'Hello',
            'body'           => '<p>Hi Jane</p>',
            'jobInfo'        => [
                'messageType' => 'an email',
                'recipient'   => 'Jane Doe',
            ],
        ]);

        $this->assertSame(7, $email->notificationId);
        $this->assertSame(42, $email->envelopeId);
        $this->assertSame('jane@example.com', $email->to);
        $this->assertSame('Hello', $email->subject);
        $this->assertSame('<p>Hi Jane</p>', $email->body);
        $this->assertSame('an email', $email->jobInfo['messageType']);
        $this->assertSame('Jane Doe', $email->jobInfo['recipient']);
    }

    // ========================================================================= //
    // Source-level guards
    // ========================================================================= //

    public function testSendUsesCraftMailer(): void
    {
        // OutboundEmail must dispatch through Craft's native mailer so that
        // host-app email transport / Mailgun / etc. settings are respected.
        $path = dirname(__DIR__, 2) . '/src/models/OutboundEmail.php';
        $source = file_get_contents($path);

        $this->assertStringContainsString('Craft::$app->getMailer()->send', $source);
    }

    public function testSendBailsWhenRecipientMissing(): void
    {
        // No recipient → log error → bail (returns false).
        // This guards against silently dropping mail without a log entry.
        $path = dirname(__DIR__, 2) . '/src/models/OutboundEmail.php';
        $source = file_get_contents($path);

        $this->assertMatchesRegularExpression(
            '/if\s*\(\s*!\$this->to\s*\)/',
            $source,
            'OutboundEmail::send must short-circuit when $to is empty'
        );
    }

    public function testSendBailsWhenBodyMissing(): void
    {
        // Empty body should never reach the mailer.
        $path = dirname(__DIR__, 2) . '/src/models/OutboundEmail.php';
        $source = file_get_contents($path);

        $this->assertMatchesRegularExpression(
            '/if\s*\(\s*!\$this->body\s*\)/',
            $source
        );
    }
}
