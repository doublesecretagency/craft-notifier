<?php
/**
 * Notifier plugin for Craft CMS
 *
 * First-class Notifications for Craft CMS.
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

namespace doublesecretagency\notifier\tests\unit;

use PHPUnit\Framework\TestCase;

/**
 * Source-level guards on the "Send a test message" button template.
 *
 * The button must stay hidden until a notification has been saved at least
 * once. Craft auto-creates an unpublished draft on the "new" screen so the
 * older `notification.id` check evaluates true before any real save. The
 * `not notification.isUnpublishedDraft` clause pins this in place.
 *
 * @since 3.0.0
 */
class SendTestTemplateTest extends TestCase
{

    /**
     * @var string Cached send-test template source.
     */
    private static string $source;

    public static function setUpBeforeClass(): void
    {
        $path = dirname(__DIR__, 2) . '/src/templates/notifications/_edit/send-test.twig';
        if (!file_exists($path)) {
            throw new \RuntimeException("Missing template: $path");
        }
        self::$source = file_get_contents($path);
    }

    public function testButtonRequiresNotificationToBeSaved(): void
    {
        // The visibility guard must include the "not unpublished draft" clause
        $this->assertMatchesRegularExpression(
            '/notification\.id\s+and\s+not\s+notification\.isUnpublishedDraft\s+and\s+currentUser\.can\(/',
            self::$source
        );
    }

    public function testButtonStillRequiresTestPermission(): void
    {
        // The dedicated test permission gate must remain intact
        $this->assertStringContainsString(
            "currentUser.can('notifier-testNotifications')",
            self::$source
        );
    }

    public function testButtonCarriesTestNotificationIdAttribute(): void
    {
        // The frontend JS reads the id from data-notifier-test-id, so the
        // attribute must stay wired to notification.id
        $this->assertStringContainsString(
            'data-notifier-test-id="{{ notification.id }}"',
            self::$source
        );
    }

}
