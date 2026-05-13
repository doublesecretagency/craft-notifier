<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\models\BaseEnvelope;
use doublesecretagency\notifier\models\OutboundNtfy;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionMethod;

/**
 * Pure-unit + source-level tests for the OutboundNtfy envelope.
 *
 * The Guzzle call cannot be exercised against the real network here, so the
 * envelope's HTTP-mechanics are verified at the source level (Craft Guzzle
 * client + header composition + bearer-token branch + status checks).
 */
class OutboundNtfyTest extends TestCase
{
    private string $ntfySource;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/models/OutboundNtfy.php';
        $this->assertTrue(file_exists($path), "OutboundNtfy.php should exist at: $path");
        $this->ntfySource = file_get_contents($path);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testExtendsBaseEnvelope(): void
    {
        $reflection = new ReflectionClass(OutboundNtfy::class);
        $this->assertTrue($reflection->isSubclassOf(BaseEnvelope::class));
    }

    public function testHasSendMethod(): void
    {
        $reflection = new ReflectionClass(OutboundNtfy::class);
        $this->assertTrue($reflection->hasMethod('send'));
        $this->assertTrue($reflection->getMethod('send')->isPublic());
    }

    // ========================================================================= //
    // Property defaults
    // ========================================================================= //

    public function testDefaultProperties(): void
    {
        $env = new OutboundNtfy();

        $this->assertNull($env->topic);
        $this->assertSame('', $env->title);
        $this->assertSame('', $env->body);
        $this->assertSame(3, $env->priority);
        $this->assertNull($env->tags);
        $this->assertNull($env->clickUrl);
        $this->assertFalse($env->markdown);
    }

    public function testConstructorHydratesAllProperties(): void
    {
        $env = new OutboundNtfy([
            'topic'    => 'release-events',
            'title'    => 'Hello',
            'body'     => 'Something happened.',
            'priority' => 5,
            'tags'     => 'fire,warning',
            'clickUrl' => 'https://example.com/foo',
            'markdown' => true,
        ]);

        $this->assertSame('release-events', $env->topic);
        $this->assertSame('Hello', $env->title);
        $this->assertSame('Something happened.', $env->body);
        $this->assertSame(5, $env->priority);
        $this->assertSame('fire,warning', $env->tags);
        $this->assertSame('https://example.com/foo', $env->clickUrl);
        $this->assertTrue($env->markdown);
    }

    // ========================================================================= //
    // Source-level guards
    // ========================================================================= //

    public function testSendUsesCraftGuzzleClient(): void
    {
        $this->assertStringContainsString('Craft::createGuzzleClient()', $this->ntfySource);
    }

    public function testSendBuildsEndpointFromServerUrlPlusTopic(): void
    {
        $this->assertMatchesRegularExpression(
            '/rtrim\(\s*\$serverUrl\s*,\s*[\'"]\/[\'"]\s*\)\s*\.\s*[\'"]\/[\'"]\s*\.\s*\$this->topic/',
            $this->ntfySource
        );
    }

    public function testSendIncludesAuthorizationHeaderWhenTokenSet(): void
    {
        $this->assertStringContainsString("'Authorization'", $this->ntfySource);
        $this->assertStringContainsString('Bearer', $this->ntfySource);
    }

    public function testSendOmitsAuthorizationHeaderWhenTokenMissing(): void
    {
        // The Authorization branch must be conditional on the token existing
        $this->assertMatchesRegularExpression(
            '/if\s*\(\s*\$accessToken\s*\)\s*{/',
            $this->ntfySource
        );
    }

    public function testSendClampsPriorityToValidRange(): void
    {
        $this->assertMatchesRegularExpression(
            '/max\s*\(\s*1\s*,\s*min\s*\(\s*5\s*,\s*\$this->priority\s*\)\s*\)/',
            $this->ntfySource
        );
    }

    public function testSendSetsMarkdownHeaderWhenEnabled(): void
    {
        $this->assertStringContainsString("'Markdown'", $this->ntfySource);
    }

    public function testSendUsesEnvParseForSettings(): void
    {
        $this->assertStringContainsString('App::parseEnv($settings->ntfyServerUrl)', $this->ntfySource);
        $this->assertStringContainsString('App::parseEnv($settings->ntfyAccessToken)', $this->ntfySource);
    }

    public function testSendLogsErrorOnFailureAndReturnsFalse(): void
    {
        // Both failure modes log via $notification->log->error(...) tagged with envelopeId
        $this->assertMatchesRegularExpression(
            '/\$notification->log->error\([^;]*\$this->envelopeId\)/',
            $this->ntfySource
        );
        // Multiple `return false` branches
        $this->assertGreaterThanOrEqual(2, substr_count($this->ntfySource, 'return false;'));
    }

    public function testSendLogsSuccessOnSuccess(): void
    {
        $this->assertStringContainsString('$notification->log->success(', $this->ntfySource);
    }

    public function testSendBailsWhenTopicMissing(): void
    {
        // No topic on the recipient must bail before composing the request
        $this->assertStringContainsString('if (!$this->topic)', $this->ntfySource);
    }

    public function testSendFallsBackToPublicNtfyServer(): void
    {
        // A blank/unset ntfyServerUrl falls back to the public ntfy.sh host
        $this->assertStringContainsString("?: 'https://ntfy.sh'", $this->ntfySource);
    }

    public function testSendEncodesTitleHeaderConditionally(): void
    {
        // The Title header is only emitted for a non-empty title, routed through _encodeHeaderValue()
        $this->assertStringContainsString("if (\$this->title !== '')", $this->ntfySource);
        $this->assertStringContainsString('$this->_encodeHeaderValue($this->title)', $this->ntfySource);
    }

    public function testSendSetsTagsAndClickHeadersConditionally(): void
    {
        // Optional Tags / Click headers are each guarded on their property being set
        $this->assertStringContainsString('if ($this->tags)', $this->ntfySource);
        $this->assertStringContainsString("\$headers['Tags'] = \$this->tags", $this->ntfySource);
        $this->assertStringContainsString('if ($this->clickUrl)', $this->ntfySource);
        $this->assertStringContainsString("\$headers['Click'] = \$this->clickUrl", $this->ntfySource);
    }

    // ========================================================================= //
    // Header encoding (pure unit)
    // ========================================================================= //

    public function testEncodeHeaderValueLeavesAsciiUntouched(): void
    {
        // A printable-ASCII title passes through unchanged for log readability
        $this->assertSame(
            'Plain ASCII title 123',
            $this->_invokeEncodeHeaderValue('Plain ASCII title 123')
        );
    }

    public function testEncodeHeaderValueRfc2047EncodesNonAscii(): void
    {
        // Non-ASCII content is base64-wrapped as an RFC 2047 encoded-word
        $value = 'Café 🎉';
        $this->assertSame(
            '=?UTF-8?B?'.base64_encode($value).'?=',
            $this->_invokeEncodeHeaderValue($value)
        );
    }

    public function testEncodeHeaderValueEncodesControlCharacters(): void
    {
        // A newline is outside printable ASCII, so the value must be encoded
        $this->assertStringStartsWith(
            '=?UTF-8?B?',
            $this->_invokeEncodeHeaderValue("Line one\nLine two")
        );
    }

    // ========================================================================= //

    /**
     * Invoke the private _encodeHeaderValue() helper via reflection.
     */
    private function _invokeEncodeHeaderValue(string $value): string
    {
        $method = new ReflectionMethod(OutboundNtfy::class, '_encodeHeaderValue');
        $method->setAccessible(true);
        return $method->invoke(new OutboundNtfy(), $value);
    }
}
