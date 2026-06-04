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
 * Source-level guards on the "Send" button template for report event types.
 *
 * Report event types (System Snapshot, Dynamic Data) have no element to hang a
 * manual trigger off, so they get their own on-demand Send button instead of the
 * test button. Like the test button, it stays hidden until the notification has
 * been saved at least once (the `not notification.isUnpublishedDraft` clause),
 * and it gates on the manual-send permission rather than the test permission.
 *
 * The CP edit screen picks send-report vs send-test in PHP before loading either
 * template, so this test also pins that branch in both call sites.
 *
 * @since 3.1.0
 */
class SendReportTemplateTest extends TestCase
{

    /**
     * @var string Cached send-report template source.
     */
    private static string $source;

    public static function setUpBeforeClass(): void
    {
        $path = dirname(__DIR__, 2) . '/src/templates/notifications/_edit/send-report.twig';
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

    public function testButtonRequiresManualSendPermission(): void
    {
        // The manual-send permission gate must remain intact (NOT the test permission)
        $this->assertStringContainsString(
            "currentUser.can('notifier-sendManualNotifications')",
            self::$source
        );
    }

    public function testButtonCarriesSendNotificationIdAttribute(): void
    {
        // The frontend JS reads the id from data-notifier-send-id, so the
        // attribute must stay wired to notification.id
        $this->assertStringContainsString(
            'data-notifier-send-id="{{ notification.id }}"',
            self::$source
        );
    }

    public function testRegistersReportNotificationAsset(): void
    {
        // The button's click handler ships via ReportNotificationAsset
        $this->assertStringContainsString(
            'ReportNotificationAsset',
            self::$source
        );
    }

    public function testPerTypeSendLabels(): void
    {
        // Each report type names its own button
        $this->assertStringContainsString("'Send system snapshot'|t('notifier')", self::$source);
        $this->assertStringContainsString("'Send data report'|t('notifier')", self::$source);
    }

    public function testCpEditScreensSelectSendReportForReportTypes(): void
    {
        // Both CP edit-screen setups (element + controller) must branch to the
        // send-report template for report event types, before loading it.
        $files = [
            dirname(__DIR__, 2) . '/src/elements/Notification.php',
            dirname(__DIR__, 2) . '/src/controllers/NotificationsController.php',
        ];
        foreach ($files as $file) {
            $source = file_get_contents($file);
            $this->assertStringContainsString(
                "? 'send-report' : 'send-test'",
                $source,
                "Missing send-report/send-test branch in: $file"
            );
        }
    }

}
