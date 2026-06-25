<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\db\Migration;
use doublesecretagency\notifier\migrations\m260624_120000_linkedinconnections;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the LinkedIn connections migration.
 *
 * The `notifier_linkedinconnections` table stores each authorized member feed
 * or organization page, with access/refresh tokens encrypted at rest. Unlike
 * the tracking tables, connections are global (not tied to a notification), so
 * there is no notificationId column and no foreign key. The unique index on
 * `uid` is how a connection is referenced as a recipient.
 */
class LinkedinConnectionsMigrationTest extends TestCase
{
    private string $migrationSource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/migrations/m260624_120000_linkedinconnections.php';
        $this->assertTrue(file_exists($path), "Migration should exist at: $path");
        $this->migrationSource = file_get_contents($path);
        $this->reflection = new ReflectionClass(m260624_120000_linkedinconnections::class);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testExtendsMigration(): void
    {
        $this->assertTrue($this->reflection->isSubclassOf(Migration::class));
    }

    public function testHasSafeUpAndSafeDown(): void
    {
        $this->assertTrue($this->reflection->hasMethod('safeUp'));
        $this->assertTrue($this->reflection->hasMethod('safeDown'));
    }

    public function testSafeUpIsIdempotent(): void
    {
        // The table-exists guard lets the migration co-exist with the Install
        // migration, which also creates this table for fresh installs.
        $this->assertStringContainsString('tableExists', $this->migrationSource);
    }

    // ========================================================================= //
    // Table schema
    // ========================================================================= //

    public function testCreatesConnectionsTable(): void
    {
        $this->assertStringContainsString(
            '{{%notifier_linkedinconnections}}',
            $this->migrationSource
        );
    }

    public function testDeclaresAuthorColumns(): void
    {
        // Each connection records what it posts as: a member or an organization,
        // identified by its author URN.
        $this->assertMatchesRegularExpression(
            "/'authorType'\s*=>\s*\\\$this->string\(\)->notNull\(\)/",
            $this->migrationSource
        );
        $this->assertMatchesRegularExpression(
            "/'authorUrn'\s*=>\s*\\\$this->string\(\)->notNull\(\)/",
            $this->migrationSource
        );
    }

    public function testDeclaresEncryptedTokenColumns(): void
    {
        // Tokens are encrypted before the write, so the columns are text. The
        // access token is required; the refresh token is nullable (standard-tier
        // apps receive none).
        $this->assertMatchesRegularExpression(
            "/'accessToken'\s*=>\s*\\\$this->text\(\)->notNull\(\)/",
            $this->migrationSource
        );
        $this->assertMatchesRegularExpression(
            "/'refreshToken'\s*=>\s*\\\$this->text\(\)->null\(\)/",
            $this->migrationSource
        );
    }

    public function testDeclaresExpiryColumns(): void
    {
        $this->assertMatchesRegularExpression(
            "/'accessExpiresAt'\s*=>\s*\\\$this->dateTime\(\)->null\(\)/",
            $this->migrationSource
        );
        $this->assertMatchesRegularExpression(
            "/'refreshExpiresAt'\s*=>\s*\\\$this->dateTime\(\)->null\(\)/",
            $this->migrationSource
        );
    }

    // ========================================================================= //
    // Index and foreign key
    // ========================================================================= //

    public function testCreatesUniqueIndexOnUid(): void
    {
        // A connection is referenced as a recipient by its UID, which must be unique.
        $this->assertMatchesRegularExpression(
            "/createIndex\([\s\S]*?'uid'[\s\S]*?true\)/",
            $this->migrationSource
        );
    }

    public function testHasNoForeignKey(): void
    {
        // Connections are global, not per-notification, so there is no FK.
        $this->assertStringNotContainsString('addForeignKey', $this->migrationSource);
    }
}
