<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\models\Recipient;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Pure-unit tests for the Recipient value object.
 *
 * Recipient wraps a raw bundle of (User|null, contact info, field handles)
 * and is responsible for deriving a display name + primary contact value
 * for log legibility. The tests below cover the parts that run without a
 * Craft container (no User instance required); the User-bound extraction
 * paths are checked via source-level assertions to avoid bootstrapping
 * Craft.
 */
class RecipientModelTest extends TestCase
{
    private string $recipientSource;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/models/Recipient.php';
        $this->assertTrue(file_exists($path), "Recipient.php should exist at: $path");
        $this->recipientSource = file_get_contents($path);
    }

    // ========================================================================= //
    // Property defaults
    // ========================================================================= //

    public function testNewRecipientHasNullProperties(): void
    {
        $recipient = new Recipient();

        $this->assertNull($recipient->user);
        $this->assertNull($recipient->emailField);
        $this->assertNull($recipient->smsField);
        $this->assertNull($recipient->name);
        $this->assertNull($recipient->emailAddress);
        $this->assertNull($recipient->phoneNumber);
        $this->assertNull($recipient->topic);
        $this->assertNull($recipient->slackBotToken);
        $this->assertNull($recipient->slackChannelId);
        $this->assertNull($recipient->slackChannelLabel);
        $this->assertNull($recipient->blueskyHandle);
        $this->assertNull($recipient->blueskyAppPassword);
    }

    public function testNameDerivedFromSlackLabelWhenNoEmailOrPhone(): void
    {
        $recipient = new Recipient([
            'slackChannelLabel' => 'engineering',
        ]);
        $this->assertSame('engineering', $recipient->name);
    }

    public function testNameDerivedFromBlueskyHandleWhenNoOtherChannel(): void
    {
        $recipient = new Recipient([
            'blueskyHandle' => 'example.bsky.social',
        ]);
        $this->assertSame('example.bsky.social', $recipient->name);
    }

    public function testNameDerivedFromNtfyTopicWhenNoOtherChannel(): void
    {
        $recipient = new Recipient([
            'topic' => 'release-events',
        ]);
        $this->assertSame('release-events', $recipient->name);
    }

    public function testEmptyRecipientStringifiesToEmptyString(): void
    {
        $recipient = new Recipient();
        $this->assertSame('', (string) $recipient);
    }

    // ========================================================================= //
    // Name derivation when no User is attached
    // ========================================================================= //

    public function testNameDerivedFromEmailAddressWhenNoUser(): void
    {
        // A raw email-only recipient (e.g. authored via Dynamic Recipients)
        // should surface its email as the display name in log rows.
        $recipient = new Recipient([
            'emailAddress' => 'jane@example.com',
        ]);

        $this->assertSame('jane@example.com', $recipient->name);
        $this->assertSame('jane@example.com', (string) $recipient);
    }

    public function testNameDerivedFromPhoneNumberWhenNoEmail(): void
    {
        // A phone-only recipient should surface the phone number as the display name.
        $recipient = new Recipient([
            'phoneNumber' => '+15555550000',
        ]);

        $this->assertSame('+15555550000', $recipient->name);
        $this->assertSame('+15555550000', (string) $recipient);
    }

    public function testEmailWinsOverPhoneInNameDerivation(): void
    {
        // When both raw email and raw phone are supplied, the email is used as the name.
        $recipient = new Recipient([
            'emailAddress' => 'jane@example.com',
            'phoneNumber'  => '+15555550000',
        ]);

        $this->assertSame('jane@example.com', $recipient->name);
    }

    public function testPresetNameIsNotOverwrittenByContactInfo(): void
    {
        // An explicit name beats any derived value.
        $recipient = new Recipient([
            'name'         => 'Jane Doe',
            'emailAddress' => 'jane@example.com',
        ]);

        $this->assertSame('Jane Doe', $recipient->name);
        $this->assertSame('Jane Doe', (string) $recipient);
    }

    // ========================================================================= //
    // __toString priority
    // ========================================================================= //

    public function testToStringPrefersNameThenEmail(): void
    {
        // Name wins over email
        $recipient = new Recipient([
            'name'         => 'Jane Doe',
            'emailAddress' => 'jane@example.com',
        ]);
        $this->assertSame('Jane Doe', (string) $recipient);
    }

    public function testToStringFallsBackToEmailWhenNameIsAbsent(): void
    {
        // After init() runs, a plain-email recipient ends up with name === email,
        // so __toString returns the same value either way. Verify the call.
        $recipient = new Recipient(['emailAddress' => 'jane@example.com']);
        $this->assertSame('jane@example.com', (string) $recipient);
    }

    // ========================================================================= //
    // User-bound extraction (verified at the source level)
    // ========================================================================= //

    public function testSourceReadsAlternateEmailFieldFromUser(): void
    {
        // When `emailField` is configured, the User-extraction code should
        // read $user->{$emailField} rather than $user->email so that
        // alternate-email handles work end-to-end.
        $this->assertMatchesRegularExpression(
            '/\$this->user->\{\$this->emailField\}/',
            $this->recipientSource,
            'Recipient should read alternate email via $user->{$this->emailField}'
        );
    }

    public function testSourceFallsBackToNativeUserEmail(): void
    {
        // When no emailField is set, the User's native email property is used.
        $this->assertMatchesRegularExpression(
            '/\$this->user->email/',
            $this->recipientSource,
            'Recipient should fall back to the User\'s native email property'
        );
    }

    public function testSourceReadsSmsFieldFromUser(): void
    {
        // smsField is always a custom handle (no native equivalent on User);
        // the extraction must therefore go through $user->{$this->smsField}.
        $this->assertMatchesRegularExpression(
            '/\$this->user->\{\$this->smsField\}/',
            $this->recipientSource,
            'Recipient should read SMS contact via $user->{$this->smsField}'
        );
    }

    public function testInitMethodIsHookedForExtraction(): void
    {
        // Recipient must run extraction during init(), not during getter calls,
        // so subsequent reads of name/emailAddress/phoneNumber are populated.
        $reflection = new ReflectionClass(Recipient::class);
        $this->assertTrue($reflection->hasMethod('init'));
        $this->assertTrue($reflection->getMethod('init')->isPublic());
    }

    public function testExtractUserDataIsPrivate(): void
    {
        // Underscore-prefixed private helper, per the project's house style.
        $reflection = new ReflectionClass(Recipient::class);
        $this->assertTrue($reflection->hasMethod('_extractUserData'));
        $this->assertTrue($reflection->getMethod('_extractUserData')->isPrivate());
    }
}
