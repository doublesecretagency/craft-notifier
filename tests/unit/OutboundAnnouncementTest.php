<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\models\BaseEnvelope;
use doublesecretagency\notifier\models\OutboundAnnouncement;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Pure-unit tests for the OutboundAnnouncement envelope.
 *
 * Announcements are pushed into Craft's CP announcement service. These
 * tests cover the envelope's state and verify that the send() path
 * dispatches through the announcements API.
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
        // adminsOnly defaults to false — broadcasts to all CP users by default.
        $this->assertFalse($announcement->adminsOnly);
    }

    // ========================================================================= //
    // Constructor hydration
    // ========================================================================= //

    public function testConstructorHydratesAllFields(): void
    {
        $announcement = new OutboundAnnouncement([
            'notificationId' => 3,
            'envelopeId'     => 11,
            'title'          => 'New release',
            'message'        => 'Notifier 3.0 is live.',
            'adminsOnly'     => true,
        ]);

        $this->assertSame(3, $announcement->notificationId);
        $this->assertSame(11, $announcement->envelopeId);
        $this->assertSame('New release', $announcement->title);
        $this->assertSame('Notifier 3.0 is live.', $announcement->message);
        $this->assertTrue($announcement->adminsOnly);
    }

    // ========================================================================= //
    // Source-level guards
    // ========================================================================= //

    public function testSendDispatchesViaCraftAnnouncements(): void
    {
        // Announcement delivery rides on Craft's CP announcements API.
        $this->assertStringContainsString(
            'Craft::$app->getAnnouncements()->push',
            $this->announcementSource
        );
    }

    public function testSendPassesAdminsOnlyToAnnouncementService(): void
    {
        // The adminsOnly flag must reach Craft's announcement push call so
        // that the audience is honored at the announcement-service layer too.
        $this->assertStringContainsString('$this->adminsOnly', $this->announcementSource);
    }

    public function testSendUsesNotifierAsAnnouncementSource(): void
    {
        // The push call tags the announcement with the 'notifier' source so
        // the CP can attribute / filter it appropriately.
        $this->assertStringContainsString("'notifier'", $this->announcementSource);
    }
}
