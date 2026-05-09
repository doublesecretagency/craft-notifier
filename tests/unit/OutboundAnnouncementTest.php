<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\models\BaseEnvelope;
use doublesecretagency\notifier\models\OutboundAnnouncement;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Pure-unit tests for the OutboundAnnouncement envelope.
 *
 * Announcements are written directly into Craft's announcements table
 * (one row per recipient). These tests cover the envelope's state and
 * verify that the send() path inserts a properly-shaped row.
 */
class OutboundAnnouncementTest extends TestCase
{
    private string $announcementSource;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/models/OutboundAnnouncement.php';
        $this->assertTrue(file_exists($path), "OutboundAnnouncement.php should exist at: $path");
        $this->announcementSource = file_get_contents($path);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testExtendsBaseEnvelope(): void
    {
        $reflection = new ReflectionClass(OutboundAnnouncement::class);
        $this->assertTrue($reflection->isSubclassOf(BaseEnvelope::class));
    }

    public function testHasSendMethod(): void
    {
        $reflection = new ReflectionClass(OutboundAnnouncement::class);
        $this->assertTrue($reflection->hasMethod('send'));
        $this->assertTrue($reflection->getMethod('send')->isPublic());
    }

    // ========================================================================= //
    // Property defaults
    // ========================================================================= //

    public function testDefaultProperties(): void
    {
        $announcement = new OutboundAnnouncement();

        $this->assertSame('', $announcement->title);
        $this->assertSame('', $announcement->message);
        // userId defaults to null until the dispatch sets it from the resolved Recipient.
        $this->assertNull($announcement->userId);
    }

    // ========================================================================= //
    // Constructor hydration
    // ========================================================================= //

    public function testConstructorHydratesAllFields(): void
    {
        $announcement = new OutboundAnnouncement([
            'notificationId' => 3,
            'envelopeId'     => 11,
            'userId'         => 42,
            'pluginId'       => 7,
            'title'          => 'New release',
            'message'        => 'Notifier 3.0 is live.',
        ]);

        $this->assertSame(3, $announcement->notificationId);
        $this->assertSame(11, $announcement->envelopeId);
        $this->assertSame(42, $announcement->userId);
        $this->assertSame(7, $announcement->pluginId);
        $this->assertSame('New release', $announcement->title);
        $this->assertSame('Notifier 3.0 is live.', $announcement->message);
    }

    // ========================================================================= //
    // Source-level guards
    // ========================================================================= //

    public function testSendInsertsIntoAnnouncementsTable(): void
    {
        // Announcement delivery now writes one row per recipient directly into
        // Craft's announcements table, bypassing the binary admins-only API.
        $this->assertStringContainsString('Table::ANNOUNCEMENTS', $this->announcementSource);
        $this->assertStringContainsString('createCommand()', $this->announcementSource);
        $this->assertStringContainsString('->insert(', $this->announcementSource);
    }

    public function testSendPersistsUserIdHeadingAndBody(): void
    {
        // The inserted row must carry the recipient userId plus the rendered
        // heading and body. Match on the array keys; values are bound by reference.
        $this->assertStringContainsString("'userId'", $this->announcementSource);
        $this->assertStringContainsString("'heading'", $this->announcementSource);
        $this->assertStringContainsString("'body'", $this->announcementSource);
        $this->assertStringContainsString('$this->userId', $this->announcementSource);
        $this->assertStringContainsString('$this->title', $this->announcementSource);
        $this->assertStringContainsString('$this->message', $this->announcementSource);
    }

    public function testSendUsesCarriedPluginIdWithoutQuerying(): void
    {
        // The pluginId rides along on the envelope (resolved once at compile
        // time in Dispatch). send() must use the carried value rather than
        // re-querying for every recipient. A 2000-recipient announcement
        // would otherwise issue 2000 redundant lookups.
        $this->assertStringContainsString("'pluginId'", $this->announcementSource);
        $this->assertStringContainsString('$this->pluginId', $this->announcementSource);
        $this->assertStringNotContainsString('Table::PLUGINS', $this->announcementSource);
    }

    public function testSendNoLongerCallsAnnouncementsServicePush(): void
    {
        // Bypassing the admins-only API is the whole point of the refactor;
        // any leftover call here would re-introduce the binary toggle behavior.
        $this->assertStringNotContainsString('getAnnouncements()->push', $this->announcementSource);
    }

    public function testSendBailsWithoutUserId(): void
    {
        // The announcements table requires a userId. Without one, the envelope
        // logs an error and bails rather than inserting a malformed row.
        $this->assertStringContainsString('!$this->userId', $this->announcementSource);
        $this->assertStringContainsString('log->error', $this->announcementSource);
    }
}
