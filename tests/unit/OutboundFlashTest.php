<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\models\BaseEnvelope;
use doublesecretagency\notifier\models\OutboundFlash;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Pure-unit tests for the OutboundFlash envelope.
 *
 * Flash messages are session-scoped and only meaningful in the current
 * web request, so they are dispatched in-process (never queued). These
 * tests cover the envelope's state and verify the session-flash branches.
 */
class OutboundFlashTest extends TestCase
{
    private string $flashSource;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/models/OutboundFlash.php';
        $this->assertTrue(file_exists($path), "OutboundFlash.php should exist at: $path");
        $this->flashSource = file_get_contents($path);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testExtendsBaseEnvelope(): void
    {
        $reflection = new ReflectionClass(OutboundFlash::class);
        $this->assertTrue($reflection->isSubclassOf(BaseEnvelope::class));
    }

    public function testHasSendMethod(): void
    {
        $reflection = new ReflectionClass(OutboundFlash::class);
        $this->assertTrue($reflection->hasMethod('send'));
        $this->assertTrue($reflection->getMethod('send')->isPublic());
    }

    // ========================================================================= //
    // Property defaults
    // ========================================================================= //

    public function testDefaultProperties(): void
    {
        $flash = new OutboundFlash();

        // Default flash type is 'notice' — the CP renders this with a neutral icon.
        $this->assertSame('notice', $flash->type);
        $this->assertSame('', $flash->title);
        $this->assertSame('', $flash->message);
    }

    // ========================================================================= //
    // Constructor hydration
    // ========================================================================= //

    public function testConstructorHydratesAllFields(): void
    {
        $flash = new OutboundFlash([
            'notificationId' => 5,
            'envelopeId'     => 17,
            'type'           => 'success',
            'title'          => 'Saved',
            'message'        => 'Changes have been saved.',
        ]);

        $this->assertSame(5, $flash->notificationId);
        $this->assertSame(17, $flash->envelopeId);
        $this->assertSame('success', $flash->type);
        $this->assertSame('Saved', $flash->title);
        $this->assertSame('Changes have been saved.', $flash->message);
    }

    // ========================================================================= //
    // Source-level guards
    // ========================================================================= //

    public function testSendBranchesOnAllThreeFlashTypes(): void
    {
        // The three CP-supported flash types must each have an explicit branch.
        $this->assertMatchesRegularExpression(
            "/case\s+'success'/",
            $this->flashSource
        );
        $this->assertMatchesRegularExpression(
            "/case\s+'notice'/",
            $this->flashSource
        );
        $this->assertMatchesRegularExpression(
            "/case\s+'error'/",
            $this->flashSource
        );
    }

    public function testInvalidFlashTypeFallsThroughToWarning(): void
    {
        // An unknown flash type must be logged as a warning rather than
        // silently dropped or incorrectly mapped to a default.
        $this->assertStringContainsString('default:', $this->flashSource);
        $this->assertMatchesRegularExpression(
            '/log->warning.*invalid flash type/i',
            $this->flashSource
        );
    }

    public function testSendUsesCraftSession(): void
    {
        // Flash messages ride on Craft's session service.
        $this->assertStringContainsString('Craft::$app->getSession()', $this->flashSource);
        $this->assertStringContainsString('setSuccess', $this->flashSource);
        $this->assertStringContainsString('setNotice', $this->flashSource);
        $this->assertStringContainsString('setError', $this->flashSource);
    }

    public function testSendRendersMessageThroughMarkdown(): void
    {
        // Flash details are run through Markdown so message authors can
        // include basic formatting without HTML.
        $this->assertStringContainsString('Markdown::process', $this->flashSource);
    }
}
