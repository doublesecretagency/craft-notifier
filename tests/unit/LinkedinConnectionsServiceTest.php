<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\base\Component;
use doublesecretagency\notifier\services\LinkedinConnections;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionMethod;

/**
 * Reflection / shape + pure-unit tests for the LinkedinConnections service.
 *
 * The service persists connections, encrypts/decrypts tokens via Craft's
 * security component, and refreshes access tokens before sending. Most of
 * that surface is coupled to Craft (DB, security, settings) and can only be
 * shape-checked here. The one genuinely pure helper, `_timestamp()`, parses a
 * stored UTC datetime string into a unix timestamp and is exercised directly.
 *
 * Live OAuth (code exchange, refresh, posting) is not exercisable under this
 * protocol; it is verified manually in the sandbox against a real LinkedIn app.
 */
class LinkedinConnectionsServiceTest extends TestCase
{
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $this->reflection = new ReflectionClass(LinkedinConnections::class);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testExtendsComponent(): void
    {
        $this->assertTrue($this->reflection->isSubclassOf(Component::class));
    }

    /**
     * @dataProvider publicMethodProvider
     */
    public function testExposesPublicMethod(string $method): void
    {
        $this->assertTrue(
            $this->reflection->hasMethod($method),
            "LinkedinConnections should expose the public {$method} method"
        );
        $this->assertTrue(
            $this->reflection->getMethod($method)->isPublic(),
            "{$method} should be public"
        );
    }

    public static function publicMethodProvider(): array
    {
        return [
            ['redirectUri'],
            ['authorizeUrl'],
            ['createConnectionsFromCode'],
            ['getSendableToken'],
            ['getConnections'],
            ['listForOptions'],
            ['getConnection'],
            ['deleteConnection'],
        ];
    }

    /**
     * @dataProvider privateMethodProvider
     */
    public function testKeepsHelperPrivate(string $method): void
    {
        $this->assertTrue(
            $this->reflection->hasMethod($method),
            "LinkedinConnections should define the {$method} helper"
        );
        $this->assertTrue(
            $this->reflection->getMethod($method)->isPrivate(),
            "{$method} should be private (internal helper)"
        );
    }

    public static function privateMethodProvider(): array
    {
        return [
            ['_upsertConnection'],
            ['_refreshConnection'],
            ['_tokenColumns'],
            ['_encrypt'],
            ['_decrypt'],
            ['_timestamp'],
            ['_settings'],
        ];
    }

    public function testGetSendableTokenSignature(): void
    {
        // The error slot is passed by reference so callers can surface a reason.
        $params = $this->reflection->getMethod('getSendableToken')->getParameters();
        $this->assertCount(2, $params);
        $this->assertSame('uid', $params[0]->getName());
        $this->assertSame('errorOut', $params[1]->getName());
        $this->assertTrue($params[1]->isPassedByReference());
    }

    // ========================================================================= //
    // Pure-unit: timestamp parsing
    // ========================================================================= //

    public function testTimestampParsesStoredUtcDatetime(): void
    {
        $method = new ReflectionMethod(LinkedinConnections::class, '_timestamp');
        $method->setAccessible(true);

        $service = new LinkedinConnections();

        // A stored UTC datetime string parses back to the matching unix timestamp.
        $expected = strtotime('2026-06-24 12:00:00 UTC');
        $this->assertSame($expected, $method->invoke($service, '2026-06-24 12:00:00'));
    }

    public function testTimestampReturnsNullForEmptyValue(): void
    {
        $method = new ReflectionMethod(LinkedinConnections::class, '_timestamp');
        $method->setAccessible(true);

        $service = new LinkedinConnections();

        // No stored datetime means no expiry to compare against.
        $this->assertNull($method->invoke($service, null));
        $this->assertNull($method->invoke($service, ''));
    }

    // ========================================================================= //
    // Source-level: redirect URI strips the volatile site param
    // ========================================================================= //

    public function testRedirectUriStripsSiteParam(): void
    {
        // On a multi-site install, Craft's UrlHelper::actionUrl() auto-appends the
        // current CP site as a `site=<handle>` query param, and that handle varies
        // with whichever site the admin is viewing. The OAuth redirect URI must stay
        // constant for LinkedIn's exact-match check, so redirectUri() builds the action
        // URL and then strips the site param. This pins that strip: a plain actionUrl()
        // without the removeParam() call would silently regress the multi-site connect
        // flow (the displayed/registered URL would drift by CP site). Source-level
        // because actionUrl() needs Craft's container and can't run under this protocol.
        $path = dirname(__DIR__, 2) . '/src/services/LinkedinConnections.php';
        $source = file_get_contents($path);

        // Isolate the redirectUri() method body
        $start = strpos($source, 'public function redirectUri(');
        $this->assertNotFalse($start, 'redirectUri() should exist in LinkedinConnections');
        $body = substr($source, $start, 400);

        // It builds the callback action URL, then strips the auto-appended site param
        $this->assertStringContainsString("UrlHelper::actionUrl('notifier/linkedin/callback')", $body);
        $this->assertStringContainsString("UrlHelper::removeParam(\$url, 'site')", $body);
    }

    // ========================================================================= //
    // Source-level: tokens are base64-encoded for text-column storage
    // ========================================================================= //

    public function testTokensAreBase64EncodedForTextColumnStorage(): void
    {
        // Craft's encryptByKey() returns raw binary, which a utf8mb4 text column
        // rejects on INSERT (MySQL error 1366 "Incorrect string value"). So _encrypt()
        // must base64-encode the ciphertext before it hits the accessToken/refreshToken
        // text columns, and _decrypt() must base64-decode before handing the bytes back
        // to decryptByKey(). This pins that wrap: dropping the base64 layer regresses the
        // whole connect flow (the OAuth callback dies trying to store the access token).
        // Source-level because encryptByKey() needs Craft's security component and the
        // round-trip can only be exercised manually in the sandbox, not under this protocol.
        $path = dirname(__DIR__, 2) . '/src/services/LinkedinConnections.php';
        $source = file_get_contents($path);

        // _encrypt() base64-encodes the ciphertext
        $encStart = strpos($source, 'private function _encrypt(');
        $this->assertNotFalse($encStart, '_encrypt() should exist in LinkedinConnections');
        $encBody = substr($source, $encStart, 250);
        $this->assertStringContainsString('base64_encode(', $encBody);
        $this->assertStringContainsString('encryptByKey(', $encBody);

        // _decrypt() base64-decodes before decrypting
        $decStart = strpos($source, 'private function _decrypt(');
        $this->assertNotFalse($decStart, '_decrypt() should exist in LinkedinConnections');
        $decBody = substr($source, $decStart, 400);
        $this->assertStringContainsString('decryptByKey(base64_decode(', $decBody);
    }

    // ========================================================================= //
    // Source-level: member connection labeled with the real profile name
    // ========================================================================= //

    public function testMemberConnectionUsesRealNameWithGenericFallback(): void
    {
        // The member connection's label should come from the LinkedIn profile name
        // (fetched via fetchMember's userinfo `profile` scope), falling back to the
        // generic "My LinkedIn Profile" only when no name is returned. Source-level
        // because createConnectionsFromCode is network- and Craft-coupled.
        $path = dirname(__DIR__, 2) . '/src/services/LinkedinConnections.php';
        $source = file_get_contents($path);

        // It fetches the member (urn + name), not just the urn
        $this->assertStringContainsString('LinkedinClient::fetchMember(', $source);

        // The member label is the real name, or the generic fallback
        $this->assertStringContainsString("\$member['name'] ?: Craft::t('notifier', 'My LinkedIn Profile')", $source);
    }
}
