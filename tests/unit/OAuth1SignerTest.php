<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\helpers\OAuth1Signer;
use PHPUnit\Framework\TestCase;

/**
 * Pure-unit tests for the OAuth 1.0a (HMAC-SHA1) signer.
 *
 * The signature base string and resulting signature are deterministic for a
 * fixed set of inputs (consumer/token keys, nonce, timestamp, params), so the
 * known-answer fixture below is X (Twitter)'s own documented example request
 * from their "Creating a signature" guide. The base string is the externally
 * verifiable artifact; the signature is the HMAC-SHA1 of that base string with
 * the documented signing key.
 */
class OAuth1SignerTest extends TestCase
{
    // X (Twitter)'s documented example credentials and request.
    private const CONSUMER_KEY    = 'xvz1evFS4wEEPTGEFPHBog';
    private const CONSUMER_SECRET = 'kAcSOqF21Fu85e7zjz7ZN2U4ZRhfV3WpwPAoE3Z7e';
    private const TOKEN           = '370773112-GmHxMAgYyLbNEtIKZeRNFsMKPR9EyMZeS9weJAEb';
    private const TOKEN_SECRET    = 'LswwdoUaIvS8ltyTt5jkRh4J50vUPVVHtR2YPi5kE';
    private const NONCE           = 'kYjzVBB8Y0ZFabxSWbWovY3uYSQ2pTgmZeNu2VS4cg';
    private const TIMESTAMP       = 1318622958;
    private const URL             = 'https://api.twitter.com/1.1/statuses/update.json';

    /**
     * @return array The documented request's signature parameters.
     */
    private function params(): array
    {
        return [
            'status'           => 'Hello Ladies + Gentlemen, a signed OAuth request!',
            'include_entities' => 'true',
        ];
    }

    public function testSignatureBaseStringMatchesDocumentedValue(): void
    {
        // The full param set the base string is built from (oauth_* plus the request params).
        $allParams = array_merge($this->params(), [
            'oauth_consumer_key'     => self::CONSUMER_KEY,
            'oauth_nonce'            => self::NONCE,
            'oauth_signature_method' => 'HMAC-SHA1',
            'oauth_timestamp'        => (string) self::TIMESTAMP,
            'oauth_token'            => self::TOKEN,
            'oauth_version'          => '1.0',
        ]);

        $expected = 'POST&https%3A%2F%2Fapi.twitter.com%2F1.1%2Fstatuses%2Fupdate.json&include_entities%3Dtrue%26oauth_consumer_key%3Dxvz1evFS4wEEPTGEFPHBog%26oauth_nonce%3DkYjzVBB8Y0ZFabxSWbWovY3uYSQ2pTgmZeNu2VS4cg%26oauth_signature_method%3DHMAC-SHA1%26oauth_timestamp%3D1318622958%26oauth_token%3D370773112-GmHxMAgYyLbNEtIKZeRNFsMKPR9EyMZeS9weJAEb%26oauth_version%3D1.0%26status%3DHello%2520Ladies%2520%252B%2520Gentlemen%252C%2520a%2520signed%2520OAuth%2520request%2521';

        $this->assertSame($expected, OAuth1Signer::signatureBaseString('POST', self::URL, $allParams));
    }

    public function testSignProducesTheHmacOfTheBaseString(): void
    {
        // The HMAC-SHA1 of the documented base string with the documented signing key.
        $baseString = 'POST&https%3A%2F%2Fapi.twitter.com%2F1.1%2Fstatuses%2Fupdate.json&include_entities%3Dtrue%26oauth_consumer_key%3Dxvz1evFS4wEEPTGEFPHBog%26oauth_nonce%3DkYjzVBB8Y0ZFabxSWbWovY3uYSQ2pTgmZeNu2VS4cg%26oauth_signature_method%3DHMAC-SHA1%26oauth_timestamp%3D1318622958%26oauth_token%3D370773112-GmHxMAgYyLbNEtIKZeRNFsMKPR9EyMZeS9weJAEb%26oauth_version%3D1.0%26status%3DHello%2520Ladies%2520%252B%2520Gentlemen%252C%2520a%2520signed%2520OAuth%2520request%2521';

        $this->assertSame(
            'Q0PuPlHZxp4PNPHp5wBXqjWHHd8=',
            OAuth1Signer::sign($baseString, self::CONSUMER_SECRET, self::TOKEN_SECRET)
        );
    }

    public function testAuthorizationHeaderCarriesTheExpectedSignature(): void
    {
        $header = OAuth1Signer::authorizationHeader(
            'POST',
            self::URL,
            self::CONSUMER_KEY,
            self::CONSUMER_SECRET,
            self::TOKEN,
            self::TOKEN_SECRET,
            $this->params(),
            self::NONCE,
            self::TIMESTAMP
        );

        // The header begins with the OAuth scheme.
        $this->assertStringStartsWith('OAuth ', $header);

        // It declares HMAC-SHA1 and version 1.0.
        $this->assertStringContainsString('oauth_signature_method="HMAC-SHA1"', $header);
        $this->assertStringContainsString('oauth_version="1.0"', $header);

        // The signature is present and percent-encoded; decode it back to the known answer.
        $this->assertSame(1, preg_match('/oauth_signature="([^"]+)"/', $header, $m));
        $this->assertSame('Q0PuPlHZxp4PNPHp5wBXqjWHHd8=', urldecode($m[1]));
    }

    public function testHeaderOnlyCarriesOAuthParams(): void
    {
        // Request params (status, include_entities) participate in the signature
        // but must NOT appear in the Authorization header itself.
        $header = OAuth1Signer::authorizationHeader(
            'POST',
            self::URL,
            self::CONSUMER_KEY,
            self::CONSUMER_SECRET,
            self::TOKEN,
            self::TOKEN_SECRET,
            $this->params(),
            self::NONCE,
            self::TIMESTAMP
        );

        $this->assertStringNotContainsString('status=', $header);
        $this->assertStringNotContainsString('include_entities', $header);
    }

    public function testNonceAndTimestampDefaultWhenOmitted(): void
    {
        // Two headers generated without fixed nonce/timestamp differ (fresh nonce each call).
        $a = OAuth1Signer::authorizationHeader('POST', self::URL, 'k', 's', 't', 'ts');
        $b = OAuth1Signer::authorizationHeader('POST', self::URL, 'k', 's', 't', 'ts');

        $this->assertStringContainsString('oauth_nonce=', $a);
        $this->assertNotSame($a, $b);
    }
}
