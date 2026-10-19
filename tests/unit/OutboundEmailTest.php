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
        // Recipient display name defaults to null
        $this->assertNull($email->recipientName);
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

    public function testSuccessMessageNamesRecipient(): void
    {
        // The success log names the recipient via the {name} placeholder,
        // populated from the recipientName property the compiler sets.
        $path = dirname(__DIR__, 2) . '/src/models/OutboundEmail.php';
        $source = file_get_contents($path);

        $this->assertStringContainsString('Successfully sent an email to {name}.', $source);
        $this->assertStringContainsString("'name' => \$this->recipientName", $source);
    }

    // ========================================================================= //
    // Plain-text part (#35)
    // ========================================================================= //

    public function testTextBodyIsNotTheRawHtml(): void
    {
        // Regression for #35: the text part used to receive the same HTML
        // as the HTML part, so text-only clients saw raw markup.
        $path = dirname(__DIR__, 2) . '/src/models/OutboundEmail.php';
        $source = file_get_contents($path);

        $this->assertDoesNotMatchRegularExpression(
            '/setTextBody\(\s*\$this->body\s*\)/',
            $source
        );
    }

    public function testTextBodyIsConvertedFromTheHtmlBody(): void
    {
        // The text part comes from EmailText, and is only attached when
        // the conversion leaves something behind (an image-only email
        // goes out as HTML only).
        $path = dirname(__DIR__, 2) . '/src/models/OutboundEmail.php';
        $source = file_get_contents($path);

        $this->assertStringContainsString('EmailText::fromHtml($this->body)', $source);
        $this->assertMatchesRegularExpression(
            '/if\s*\(\s*\'\'\s*!==\s*\$textBody\s*\)\s*\{\s*\$email->setTextBody\(\$textBody\);/',
            $source
        );
    }

    // ========================================================================= //
    // Before/after send events (#35)
    // ========================================================================= //

    public function testEventConstantsHaveCraftStyleValues(): void
    {
        // Same values as Craft's own Mailer events, so listeners read naturally
        $this->assertSame('beforeSend', OutboundEmail::EVENT_BEFORE_SEND);
        $this->assertSame('afterSend', OutboundEmail::EVENT_AFTER_SEND);
    }

    public function testBeforeSendFiresAfterTheEmailIsFullyBuilt(): void
    {
        // Listeners must see (and be able to override) the final bodies,
        // so the before-send trigger comes after both bodies are set and
        // before the mailer is called.
        $source = $this->_sendSource();

        $lastBody = max(strrpos($source, 'setHtmlBody('), strrpos($source, 'setTextBody('));
        $before = strpos($source, 'static::EVENT_BEFORE_SEND');
        $mailer = strpos($source, 'getMailer()->send(');

        $this->assertNotFalse($before);
        $this->assertGreaterThan($lastBody, $before);
        $this->assertLessThan($mailer, $before);
    }

    public function testCanceledEmailBailsBeforeTheMailer(): void
    {
        // A listener setting isValid = false logs a warning and returns
        // false without ever reaching the mailer.
        $source = $this->_sendSource();

        $this->assertMatchesRegularExpression(
            '/if\s*\(\s*!\$event->isValid\s*\)\s*\{[^}]*\[CANCELED\][^}]*return false;\s*\}/',
            $source
        );
        $this->assertLessThan(
            strpos($source, 'getMailer()->send('),
            strpos($source, '!$event->isValid')
        );
    }

    public function testAfterSendFiresBeforeTheFailureCheckWithTheResult(): void
    {
        // The after-send event fires on success AND failure, so it must sit
        // between the mailer call and the `[SEND FAILED]` bail, and carry
        // the mailer's result.
        $source = $this->_sendSource();

        $mailer = strpos($source, 'getMailer()->send(');
        $after = strpos($source, 'static::EVENT_AFTER_SEND');
        $failed = strpos($source, '[SEND FAILED]');

        $this->assertNotFalse($after);
        $this->assertGreaterThan($mailer, $after);
        $this->assertLessThan($failed, $after);
        $this->assertStringContainsString("'isSuccessful' => \$success", $source);
    }

    /**
     * Get the source of OutboundEmail::send().
     */
    private function _sendSource(): string
    {
        $source = file_get_contents(dirname(__DIR__, 2) . '/src/models/OutboundEmail.php');
        $start = strpos($source, 'public function send(): bool');
        $this->assertNotFalse($start, 'send() should exist in OutboundEmail.php');
        return substr($source, $start);
    }
}
