<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\models\BaseEnvelope;
use doublesecretagency\notifier\models\OutboundInstagram;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Pure-unit + source-level tests for the OutboundInstagram envelope, which
 * publishes a single image through the Meta Graph two-step container/publish
 * flow.
 *
 * The live Graph calls cannot be exercised here (no Craft bootstrap, no real
 * IG Business account), so the send mechanics are verified at the source
 * level. The pure-unit half covers property defaults, the caption limit, and
 * hydration.
 */
class OutboundInstagramTest extends TestCase
{
    private string $source;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/models/OutboundInstagram.php';
        $this->assertTrue(file_exists($path), "OutboundInstagram.php should exist at: $path");
        $this->source = file_get_contents($path);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testExtendsBaseEnvelope(): void
    {
        $reflection = new ReflectionClass(OutboundInstagram::class);
        $this->assertTrue($reflection->isSubclassOf(BaseEnvelope::class));
    }

    public function testHasPublicSendMethod(): void
    {
        $reflection = new ReflectionClass(OutboundInstagram::class);
        $this->assertTrue($reflection->hasMethod('send'));
        $this->assertTrue($reflection->getMethod('send')->isPublic());
    }

    public function testCaptionLimit(): void
    {
        // Instagram caps a caption at 2,200 characters.
        $this->assertSame(2200, OutboundInstagram::MAX_CAPTION);
    }

    public function testDefaultProperties(): void
    {
        $defaults = (new ReflectionClass(OutboundInstagram::class))->getDefaultProperties();

        $this->assertNull($defaults['igUserId']);
        $this->assertNull($defaults['pageAccessToken']);
        $this->assertNull($defaults['label']);
        $this->assertSame('', $defaults['caption']);
        $this->assertSame([], $defaults['media']);
        $this->assertSame('set', $defaults['mediaFieldState']);
    }

    public function testConstructorHydratesAllProperties(): void
    {
        $env = new OutboundInstagram([
            'igUserId'        => '17841400000000000',
            'pageAccessToken' => 'token',
            'label'           => 'Brand IG',
            'caption'         => 'Look at this!',
        ]);

        $this->assertSame('17841400000000000', $env->igUserId);
        $this->assertSame('token', $env->pageAccessToken);
        $this->assertSame('Brand IG', $env->label);
        $this->assertSame('Look at this!', $env->caption);
    }

    // ========================================================================= //
    // Source-level guards
    // ========================================================================= //

    public function testUsesTheTwoStepContainerPublishFlow(): void
    {
        $this->assertStringContainsString('MetaGraph::createImageContainer(', $this->source);
        $this->assertStringContainsString('MetaGraph::publishContainer(', $this->source);
    }

    public function testEmptyImageFieldIsAnError(): void
    {
        // An empty Image Attachment field can never post, so it errors (not a skip).
        $this->assertMatchesRegularExpression(
            '/\x27empty\x27 === \$this->mediaFieldState\)[\s\S]{0,120}?log->error\(/',
            $this->source
        );
        $this->assertStringContainsString('[MISSING IMAGE] Image Attachment field was empty.', $this->source);
    }

    public function testMissingSetMediaIsAnError(): void
    {
        // A non-empty field that never called setMedia also can never post, so it errors.
        $this->assertMatchesRegularExpression(
            '/\x27unset\x27 === \$this->mediaFieldState\)[\s\S]{0,120}?log->error\(/',
            $this->source
        );
        $this->assertStringContainsString('Image Attachment field never called the {tag} tag.', $this->source);
    }

    public function testSetMediaButNoUsableImageIsAnError(): void
    {
        // setMedia ran but produced no usable image is also an error.
        $this->assertMatchesRegularExpression(
            '/\} else \{[\s\S]{0,160}?log->error\([\s\S]*?returned an invalid image/',
            $this->source
        );
    }

    public function testPrivateVolumeImageIsAClearError(): void
    {
        // An image with no public URL is a clear error (the Graph API fetches by URL).
        $this->assertMatchesRegularExpression(
            '/if\s*\(\s*!\$image->url\s*\)\s*\{[\s\S]*?log->error\([\s\S]*?public URL/',
            $this->source
        );
    }

    public function testTruncatesCaptionToMaxCaption(): void
    {
        $this->assertMatchesRegularExpression(
            '/mb_strlen\(\$caption\)\s*>\s*static::MAX_CAPTION/',
            $this->source
        );
        $this->assertStringContainsString('mb_substr($caption, 0, static::MAX_CAPTION)', $this->source);
    }

    public function testResolvesTokenViaEnvParse(): void
    {
        $this->assertStringContainsString('App::parseEnv($this->pageAccessToken)', $this->source);
    }

    public function testResolvesIgUserIdViaEnvParse(): void
    {
        // The IG user ID supports $ENV references just like the token, so it must be parsed at send time.
        $this->assertStringContainsString('App::parseEnv($this->igUserId)', $this->source);
    }

    public function testLogsSuccessAndError(): void
    {
        $this->assertStringContainsString('$notification->log->success(', $this->source);
        $this->assertMatchesRegularExpression(
            '/\$notification->log->error\([^;]*\$this->envelopeId\)/',
            $this->source
        );
    }
}
