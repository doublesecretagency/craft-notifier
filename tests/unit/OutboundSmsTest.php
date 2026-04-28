<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\models\BaseEnvelope;
use doublesecretagency\notifier\models\OutboundSms;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionMethod;

/**
 * Pure-unit tests for the OutboundSms envelope.
 *
 * The Twilio SDK call is verified at the source level; the phone-number
 * normalizer is exercised directly via reflection because it's a pure
 * function over its string input.
 */
class OutboundSmsTest extends TestCase
{
    private string $smsSource;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/models/OutboundSms.php';
        $this->assertTrue(file_exists($path), "OutboundSms.php should exist at: $path");
        $this->smsSource = file_get_contents($path);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testExtendsBaseEnvelope(): void
    {
        $reflection = new ReflectionClass(OutboundSms::class);
        $this->assertTrue($reflection->isSubclassOf(BaseEnvelope::class));
    }

    public function testHasSendMethod(): void
    {
        $reflection = new ReflectionClass(OutboundSms::class);
        $this->assertTrue($reflection->hasMethod('send'));
        $this->assertTrue($reflection->getMethod('send')->isPublic());
    }

    // ========================================================================= //
    // Property defaults
    // ========================================================================= //

    public function testDefaultProperties(): void
    {
        $sms = new OutboundSms();

        $this->assertNull($sms->phoneNumber);
        $this->assertSame('', $sms->message);
    }

    // ========================================================================= //
    // Phone-number normalization
    // ========================================================================= //

    public function testTenDigitNumberIsTreatedAsUS(): void
    {
        // 10-digit input should be prefixed with +1 (US assumption).
        $result = $this->_invokeFormat('5555550000');
        $this->assertSame('+15555550000', $result);
    }

    public function testFormattedTenDigitNumberHasNonDigitsStripped(): void
    {
        // Common formatting characters should be stripped before normalization.
        $result = $this->_invokeFormat('(555) 555-0000');
        $this->assertSame('+15555550000', $result);
    }

    public function testInternationalNumberKeepsAllDigits(): void
    {
        // 11+ digits → assume international, just prepend +.
        $result = $this->_invokeFormat('441632960123');
        $this->assertSame('+441632960123', $result);
    }

    public function testTooShortNumberReturnsNull(): void
    {
        // Fewer than 10 digits is unusable — return null so the caller bails.
        $result = $this->_invokeFormat('555-1234');
        $this->assertNull($result);
    }

    public function testEmptyInputReturnsNull(): void
    {
        $this->assertNull($this->_invokeFormat(''));
        $this->assertNull($this->_invokeFormat(null));
    }

    public function testStrippedInternationalFormatIsPreserved(): void
    {
        // Already-prefixed international number with formatting.
        $result = $this->_invokeFormat('+44 1632 960123');
        $this->assertSame('+441632960123', $result);
    }

    // ========================================================================= //
    // Source-level guards
    // ========================================================================= //

    public function testSendChecksTwilioCredentials(): void
    {
        // Both Twilio Account SID and Auth Token must be checked before sending.
        $this->assertStringContainsString('Twilio Account SID', $this->smsSource);
        $this->assertStringContainsString('Twilio Auth Token', $this->smsSource);
    }

    public function testSendUsesTwilioRestClient(): void
    {
        // SMS dispatch goes through the Twilio REST client.
        $this->assertStringContainsString('new Client(', $this->smsSource);
        $this->assertStringContainsString('messages->create', $this->smsSource);
    }

    public function testSendUsesTestPhoneNumberWhenConfigured(): void
    {
        // testToPhoneNumber should override the recipient when set —
        // critical for keeping local development from texting real users.
        $this->assertStringContainsString('testToPhoneNumber', $this->smsSource);
    }

    public function testSendBailsWhenSenderMissing(): void
    {
        // No Twilio "from" number → log error → bail.
        $this->assertMatchesRegularExpression(
            '/if\s*\(\s*!\$from\s*\)/',
            $this->smsSource
        );
    }

    // ========================================================================= //
    // Helpers
    // ========================================================================= //

    /**
     * Invoke the private _formatPhoneNumber() method via reflection.
     */
    private function _invokeFormat(?string $input): ?string
    {
        $sms = new OutboundSms();
        $method = new ReflectionMethod(OutboundSms::class, '_formatPhoneNumber');
        $method->setAccessible(true);
        return $method->invoke($sms, $input);
    }
}
