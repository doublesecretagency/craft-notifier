<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\db\Migration;
use doublesecretagency\notifier\migrations\m260618_120000_widen_log_message_column;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the log-message widening migration.
 *
 * Existing installs created notifier_log.message as a VARCHAR(255), which
 * overflowed when a provider error (Facebook Graph, Twilio, etc.) exceeded
 * 255 characters and crashed the log write mid-send. This migration alters
 * the column to text on upgrade; fresh installs already create it as text.
 */
class WidenLogMessageColumnMigrationTest extends TestCase
{
    private string $migrationSource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/migrations/m260618_120000_widen_log_message_column.php';
        $this->assertTrue(file_exists($path), "Migration should exist at: $path");
        $this->migrationSource = file_get_contents($path);
        $this->reflection = new ReflectionClass(m260618_120000_widen_log_message_column::class);
    }

    public function testExtendsMigration(): void
    {
        $this->assertTrue($this->reflection->isSubclassOf(Migration::class));
    }

    public function testHasSafeUpAndSafeDown(): void
    {
        $this->assertTrue($this->reflection->hasMethod('safeUp'));
        $this->assertTrue($this->reflection->hasMethod('safeDown'));
    }

    public function testWidensMessageToText(): void
    {
        $this->assertMatchesRegularExpression(
            "/alterColumn\(self::LOG, 'message', \\\$this->text\(\)\)/",
            $this->migrationSource
        );
    }

    public function testSafeDownRevertsToString(): void
    {
        $this->assertMatchesRegularExpression(
            "/alterColumn\(self::LOG, 'message', \\\$this->string\(\)\)/",
            $this->migrationSource
        );
    }
}
