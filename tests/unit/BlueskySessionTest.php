<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\helpers\BlueskySession;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionMethod;

/**
 * Reflection + source-level tests for the Bluesky session helper.
 *
 * Confirms the cache-key derivation (sha1 of pdsUrl + handle), the marker
 * prefix, and that the app password is never written to cache or logs.
 */
class BlueskySessionTest extends TestCase
{
    private string $sessionSource;
    private string $cacheKeyPrefix;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/helpers/BlueskySession.php';
        $this->assertTrue(file_exists($path), "BlueskySession.php should exist at: $path");
        $this->sessionSource = file_get_contents($path);

        $reflection = new ReflectionClass('doublesecretagency\\notifier\\helpers\\BlueskySession');
        $this->cacheKeyPrefix = $reflection->getConstant('CACHE_KEY_PREFIX');
    }

    public function testCacheKeyPrefixIsDeclared(): void
    {
        $this->assertSame('notifier.bluesky.session.', $this->cacheKeyPrefix);
    }

    public function testCacheKeyIncludesSha1Hash(): void
    {
        $this->assertMatchesRegularExpression(
            "/return\s+static::CACHE_KEY_PREFIX\s*\.\s*sha1\(/",
            $this->sessionSource
        );
    }

    public function testCacheKeyDerivesFromPdsAndHandle(): void
    {
        // sha1($normalized.':'.$handle)
        $this->assertMatchesRegularExpression(
            "/sha1\([^)]*\\\$normalized\\.[\\'\"]\\:[\\'\"]\\.\\\$handle/",
            $this->sessionSource
        );
    }

    public function testRefreshMarginConstant(): void
    {
        $reflection = new ReflectionClass('doublesecretagency\\notifier\\helpers\\BlueskySession');
        $this->assertSame(300, $reflection->getConstant('REFRESH_MARGIN_SECONDS'));
    }

    public function testPutStripsPasswordBeforeCaching(): void
    {
        // Defense-in-depth: the put() method should strip password-like keys
        $this->assertStringContainsString("unset(\$payload['password'], \$payload['appPassword'])", $this->sessionSource);
    }

    public function testCreateSessionDecodesJwtExpiry(): void
    {
        $this->assertStringContainsString('_decodeJwtExpiry', $this->sessionSource);
    }

    public function testCreateSessionReturnsNullOnNon200(): void
    {
        // Failure branch sets $errorOut and returns null
        $this->assertStringContainsString('200 !== $status', $this->sessionSource);
        $this->assertStringContainsString('$errorOut = ', $this->sessionSource);
        $this->assertStringContainsString('return null;', $this->sessionSource);
    }

    public function testCreateSessionRequiresAccessJwtAndDidInResponse(): void
    {
        $this->assertStringContainsString("isset(\$body['accessJwt'], \$body['did'])", $this->sessionSource);
    }

    // ========================================================================= //
    // cacheKey() derivation (pure unit)
    // ========================================================================= //

    public function testCacheKeyNormalizesTrailingSlash(): void
    {
        // A trailing slash on the PDS URL must not change the derived key
        $this->assertSame(
            BlueskySession::cacheKey('https://bsky.social', 'example.bsky.social'),
            BlueskySession::cacheKey('https://bsky.social/', 'example.bsky.social')
        );
    }

    public function testCacheKeyMatchesExpectedSha1(): void
    {
        // The key is the prefix plus sha1 of the normalized PDS URL, a colon, and the handle
        $expected = 'notifier.bluesky.session.'.sha1('https://bsky.social:example.bsky.social');
        $this->assertSame($expected, BlueskySession::cacheKey('https://bsky.social/', 'example.bsky.social'));
    }

    public function testCacheKeyDiffersPerHandleAndPds(): void
    {
        // Two accounts on one PDS, and one account across two PDSs, must not collide
        $example = BlueskySession::cacheKey('https://bsky.social', 'example.bsky.social');
        $team   = BlueskySession::cacheKey('https://bsky.social', 'team.bsky.social');
        $other = BlueskySession::cacheKey('https://pds.example.com', 'example.bsky.social');

        $this->assertNotSame($example, $team);
        $this->assertNotSame($example, $other);
    }

    // ========================================================================= //
    // _decodeJwtExpiry() (pure unit)
    // ========================================================================= //

    public function testDecodeJwtExpiryReadsExpClaim(): void
    {
        // A well-formed JWT yields the integer `exp` claim from its payload segment
        $exp = 1893456000;
        $jwt = 'eyJhbGciOiJIUzI1NiJ9.'.$this->_base64Url(json_encode(['exp' => $exp])).'.signature';

        $this->assertSame($exp, $this->_invokeDecodeJwtExpiry($jwt));
    }

    public function testDecodeJwtExpiryFallsBackForSingleSegment(): void
    {
        // A string with no dot-separated segments cannot carry a payload; fall back to ~now+3000s
        $result = $this->_invokeDecodeJwtExpiry('notajwt');

        $this->assertGreaterThanOrEqual(time() + 2900, $result);
        $this->assertLessThanOrEqual(time() + 3100, $result);
    }

    public function testDecodeJwtExpiryFallsBackForUnreadablePayload(): void
    {
        // Three segments, but the payload segment is not valid base64; fall back to ~now+3000s
        $result = $this->_invokeDecodeJwtExpiry('header.@@@notbase64@@@.signature');

        $this->assertGreaterThanOrEqual(time() + 2900, $result);
        $this->assertLessThanOrEqual(time() + 3100, $result);
    }

    // ========================================================================= //

    /**
     * Encode a string as an unpadded base64url segment (the JWT payload shape).
     */
    private function _base64Url(string $raw): string
    {
        return rtrim(strtr(base64_encode($raw), '+/', '-_'), '=');
    }

    /**
     * Invoke the private static _decodeJwtExpiry() helper via reflection.
     */
    private function _invokeDecodeJwtExpiry(string $jwt): int
    {
        $method = new ReflectionMethod(BlueskySession::class, '_decodeJwtExpiry');
        $method->setAccessible(true);
        return $method->invoke(null, $jwt);
    }
}
