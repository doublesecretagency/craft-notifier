<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\base\Model;
use doublesecretagency\notifier\models\Settings;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Pure-unit tests for the Settings model.
 *
 * The Settings model is a flat property bag — no validation rules, no
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
}
