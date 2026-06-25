<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\base\Model;
use doublesecretagency\notifier\models\Settings;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Pure-unit tests for the Settings model.
 *
 * The Settings model is a flat property bag, no validation rules, no
 * derived state. These tests pin the property surface (names, types,
 * defaults) so silent renames or default changes can't ship without a
 * test failure to flag them.
 */
class SettingsModelTest extends TestCase
{
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $this->reflection = new ReflectionClass(Settings::class);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testExtendsCraftModel(): void
    {
        $this->assertTrue($this->reflection->isSubclassOf(Model::class));
    }

    // ========================================================================= //
    // Twilio properties
    // ========================================================================= //

    public function testTwilioPropertiesDefaultToNull(): void
    {
        $defaults = $this->reflection->getDefaultProperties();

        $this->assertNull($defaults['twilioAccountSid']);
        $this->assertNull($defaults['twilioAuthToken']);
        $this->assertNull($defaults['twilioPhoneNumber']);
        $this->assertNull($defaults['testToPhoneNumber']);
    }

    // ========================================================================= //
    // Logging properties
    // ========================================================================= //

    public function testLoggingEnabledDefaultsToTrue(): void
    {
        // Default-on so existing installs continue logging after upgrade.
        $defaults = $this->reflection->getDefaultProperties();
        $this->assertTrue($defaults['loggingEnabled']);
    }

    public function testLoggingEnabledIsBool(): void
    {
        $property = $this->reflection->getProperty('loggingEnabled');
        $type = $property->getType();

        $this->assertNotNull($type);
        $this->assertSame('bool', $type->getName());
        $this->assertFalse($type->allowsNull());
    }

    public function testLogRetentionDaysDefaultsToNull(): void
    {
        // Null = no cap; users opt in by setting an integer.
        $defaults = $this->reflection->getDefaultProperties();
        $this->assertNull($defaults['logRetentionDays']);
    }

    public function testLogRetentionDaysIsNullableInt(): void
    {
        $property = $this->reflection->getProperty('logRetentionDays');
        $type = $property->getType();

        $this->assertNotNull($type);
        $this->assertSame('int', $type->getName());
        $this->assertTrue($type->allowsNull());
    }

    public function testLogRetentionRecordsDefaultsToNull(): void
    {
        // Null = no cap; users opt in by setting an integer.
        $defaults = $this->reflection->getDefaultProperties();
        $this->assertNull($defaults['logRetentionRecords']);
    }

    public function testLogRetentionRecordsIsNullableInt(): void
    {
        $property = $this->reflection->getProperty('logRetentionRecords');
        $type = $property->getType();

        $this->assertNotNull($type);
        $this->assertSame('int', $type->getName());
        $this->assertTrue($type->allowsNull());
    }

    // ========================================================================= //
    // Pushover properties
    // ========================================================================= //

    public function testPushoverApplicationTokenDefaultsToNull(): void
    {
        $defaults = $this->reflection->getDefaultProperties();
        $this->assertNull($defaults['pushoverApplicationToken']);
    }

    // ========================================================================= //
    // ntfy properties
    // ========================================================================= //

    public function testNtfyServerUrlDefaultsToNull(): void
    {
        // Stored default is null. OutboundNtfy::send() falls back to the public ntfy.sh server at runtime.
        $defaults = $this->reflection->getDefaultProperties();
        $this->assertNull($defaults['ntfyServerUrl']);
    }

    public function testOutboundNtfyFallsBackToPublicHostWhenServerUrlUnset(): void
    {
        // Source-level regex: the send() body must contain the ?: 'https://ntfy.sh' fallback
        $path = dirname(__DIR__, 2) . '/src/models/OutboundNtfy.php';
        $source = file_get_contents($path);
        $this->assertMatchesRegularExpression(
            '/App::parseEnv\(\s*\$settings->ntfyServerUrl\s*\)\s*\?:\s*[\'"]https:\/\/ntfy\.sh[\'"]/',
            $source
        );
    }

    public function testNtfyAccessTokenDefaultsToNull(): void
    {
        $defaults = $this->reflection->getDefaultProperties();
        $this->assertNull($defaults['ntfyAccessToken']);
    }

    public function testNtfyTopicsDefaultsToEmptyArray(): void
    {
        $defaults = $this->reflection->getDefaultProperties();
        $this->assertSame([], $defaults['ntfyTopics']);
    }

    // ========================================================================= //
    // Slack properties
    // ========================================================================= //

    public function testSlackWebhooksDefaultsToEmptyArray(): void
    {
        $defaults = $this->reflection->getDefaultProperties();
        $this->assertSame([], $defaults['slackChannels']);
    }

    // ========================================================================= //
    // Bluesky properties
    // ========================================================================= //

    public function testBlueskyPdsUrlDefaultsToPublicHost(): void
    {
        $defaults = $this->reflection->getDefaultProperties();
        $this->assertSame('https://bsky.social', $defaults['blueskyPdsUrl']);
    }

    public function testBlueskyAccountsDefaultsToEmptyArray(): void
    {
        $defaults = $this->reflection->getDefaultProperties();
        $this->assertSame([], $defaults['blueskyAccounts']);
    }

    // ========================================================================= //
    // MQTT properties
    // ========================================================================= //

    public function testMqttConnectionPropertiesDefaultToNull(): void
    {
        // The broker connection fields are env-referenceable and default to null.
        $defaults = $this->reflection->getDefaultProperties();
        $this->assertNull($defaults['mqttHost']);
        $this->assertNull($defaults['mqttPort']);
        $this->assertNull($defaults['mqttUsername']);
        $this->assertNull($defaults['mqttPassword']);
        $this->assertNull($defaults['mqttClientId']);
        $this->assertNull($defaults['mqttTlsCaFile']);
        $this->assertNull($defaults['mqttTlsClientCertFile']);
        $this->assertNull($defaults['mqttTlsClientKeyFile']);
    }

    public function testMqttUseTlsDefaultsToFalse(): void
    {
        $defaults = $this->reflection->getDefaultProperties();
        $this->assertFalse($defaults['mqttUseTls']);
    }

    public function testMqttUseTlsIsBool(): void
    {
        $type = $this->reflection->getProperty('mqttUseTls')->getType();
        $this->assertNotNull($type);
        $this->assertSame('bool', $type->getName());
        $this->assertFalse($type->allowsNull());
    }

    public function testMqttPortIsNullableInt(): void
    {
        $type = $this->reflection->getProperty('mqttPort')->getType();
        $this->assertNotNull($type);
        $this->assertSame('int', $type->getName());
        $this->assertTrue($type->allowsNull());
    }

    public function testMqttProtocolLevelDefaultsToThreeOneOne(): void
    {
        // 3.1.1 is the default protocol version sent to the broker.
        $defaults = $this->reflection->getDefaultProperties();
        $this->assertSame('3.1.1', $defaults['mqttProtocolLevel']);
    }

    public function testMqttTopicsDefaultsToEmptyArray(): void
    {
        $defaults = $this->reflection->getDefaultProperties();
        $this->assertSame([], $defaults['mqttTopics']);
    }

    // ========================================================================= //
    // Discord properties
    // ========================================================================= //

    public function testDiscordChannelsDefaultsToEmptyArray(): void
    {
        $defaults = $this->reflection->getDefaultProperties();
        $this->assertSame([], $defaults['discordChannels']);
    }

    // ========================================================================= //
    // Mastodon properties
    // ========================================================================= //

    public function testMastodonAccountsDefaultsToEmptyArray(): void
    {
        $defaults = $this->reflection->getDefaultProperties();
        $this->assertSame([], $defaults['mastodonAccounts']);
    }

    // ========================================================================= //
    // LinkedIn properties
    // ========================================================================= //

    public function testLinkedinClientIdDefaultsToNull(): void
    {
        $defaults = $this->reflection->getDefaultProperties();
        $this->assertNull($defaults['linkedinClientId']);
    }

    public function testLinkedinClientSecretDefaultsToNull(): void
    {
        $defaults = $this->reflection->getDefaultProperties();
        $this->assertNull($defaults['linkedinClientSecret']);
    }

    public function testLinkedinEnableOrganizationsDefaultsToFalse(): void
    {
        // Organization posting is opt-in; it needs LinkedIn's gated Community
        // Management API approval, so it stays off until the admin turns it on.
        $defaults = $this->reflection->getDefaultProperties();
        $this->assertFalse($defaults['linkedinEnableOrganizations']);
    }

    // ========================================================================= //
    // Encryption surface removed
    // ========================================================================= //

    public function testEncryptionSurfaceIsGone(): void
    {
        // Credentials are no longer encrypted at rest. Slack webhook URLs and
        // Bluesky app passwords are stored as-is (typically as $ENV_VAR
        // references), so the model must carry no encrypt/decrypt machinery.
        $this->assertFalse($this->reflection->hasMethod('encryptValue'));
        $this->assertFalse($this->reflection->hasMethod('decryptValue'));
        $this->assertFalse($this->reflection->hasMethod('_decryptSensitiveFields'));
        $this->assertFalse($this->reflection->hasConstant('SENSITIVE_FIELDS'));
        $this->assertFalse($this->reflection->hasConstant('ENCRYPTED_MARKER'));
    }
}
