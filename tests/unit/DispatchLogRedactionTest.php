<?php
namespace doublesecretagency\notifier\tests\unit;

use PHPUnit\Framework\TestCase;

/**
 * Source-level guards that the dispatch compile methods keep raw credentials
 * out of the envelope log.
 *
 * The envelope-log call records only the friendly label / handle, never the
 * webhook URL, app password, or Pushover user key. (Migrated from the deleted
 * SettingsEncryptionTest when at-rest encryption was removed; the no-leak
 * invariant still matters independent of how credentials are stored.)
 */
class DispatchLogRedactionTest extends TestCase
{
    private string $dispatchSource;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/models/Dispatch.php';
        $this->assertTrue(file_exists($path), "Dispatch.php should exist at: $path");
        $this->dispatchSource = file_get_contents($path);
    }

    public function testCompileSlackDoesNotLogWebhookUrl(): void
    {
        // The envelope-log call in _compileSlack records the label, not the webhook URL
        $this->assertMatchesRegularExpression(
            "/function _compileSlack[\s\S]*?envelope\(\\\$jobInfo,\s*\[\s*'label'/",
            $this->dispatchSource
        );
    }

    public function testCompileBlueskyDoesNotLogAppPassword(): void
    {
        // The envelope-log call in _compileBluesky records the handle, not the app password
        $this->assertMatchesRegularExpression(
            "/function _compileBluesky[\s\S]*?envelope\(\\\$jobInfo,\s*\[\s*'handle'/",
            $this->dispatchSource
        );
    }

    public function testCompilePushoverDoesNotLogUserKey(): void
    {
        // The envelope-log call in _compilePushover records the title, not the user key
        $this->assertMatchesRegularExpression(
            "/function _compilePushover[\s\S]*?envelope\(\\\$jobInfo,\s*\[\s*'title'/",
            $this->dispatchSource
        );
    }
}
