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

namespace doublesecretagency\notifier\helpers;

/**
 * Signs requests using OAuth 1.0a (HMAC-SHA1).
 *
 * @since 3.1.0
 */
abstract class OAuth1Signer
{

    /**
     * Build an OAuth 1.0a `Authorization` header for a request.
     *
     * `$params` are any query or form parameters that get signed; a JSON body is not.
     * `$nonce` and `$timestamp` are generated fresh each call, and only tests pass fixed ones.
     *
     * @param string $method HTTP method.
     * @param string $url The request URL (without query string).
     * @param string $consumerKey
     * @param string $consumerSecret
     * @param string $token
     * @param string $tokenSecret
     * @param array $params Query/form parameters included in the signature.
     * @param string|null $nonce Optional fixed nonce.
     * @param int|null $timestamp Optional fixed Unix timestamp.
     * @return string The full `OAuth ...` header value.
     */
    public static function authorizationHeader(
        string $method,
        string $url,
        string $consumerKey,
        string $consumerSecret,
        string $token,
        string $tokenSecret,
        array $params = [],
        ?string $nonce = null,
        ?int $timestamp = null
    ): string {
        // Build the OAuth protocol parameters
        $oauth = [
            'oauth_consumer_key'     => $consumerKey,
            'oauth_nonce'            => ($nonce ?? bin2hex(random_bytes(16))),
            'oauth_signature_method' => 'HMAC-SHA1',
            'oauth_timestamp'        => (string) ($timestamp ?? time()),
            'oauth_token'            => $token,
            'oauth_version'          => '1.0',
        ];

        // Build the signature base string over the OAuth and query/form params
        $baseString = static::signatureBaseString($method, $url, array_merge($params, $oauth));

        // Sign the base string and add the signature to the OAuth params
        $oauth['oauth_signature'] = static::sign($baseString, $consumerSecret, $tokenSecret);

        // Sort the OAuth params for a stable header
        ksort($oauth);

        // Initialize the header parts
        $parts = [];

        // Build each `key="value"` pair (only OAuth params go in the header)
        foreach ($oauth as $key => $value) {
            $parts[] = rawurlencode($key).'="'.rawurlencode($value).'"';
        }

        // Return the assembled header
        return 'OAuth '.implode(', ', $parts);
    }

    /**
     * Build the OAuth 1.0a signature base string.
     *
     * @param string $method HTTP method.
     * @param string $url The request URL (without query string).
     * @param array $params All parameters participating in the signature.
     * @return string
     */
    public static function signatureBaseString(string $method, string $url, array $params): string
    {
        // Initialize the encoded params
        $encoded = [];

        // Percent-encode every key and value (RFC 3986)
        foreach ($params as $key => $value) {
            $encoded[rawurlencode((string) $key)] = rawurlencode((string) $value);
        }

        // Sort by encoded key
        ksort($encoded);

        // Initialize the encoded pairs
        $pairs = [];

        // Build each `key=value` pair
        foreach ($encoded as $key => $value) {
            $pairs[] = "{$key}={$value}";
        }

        // Join the pairs into a single `key=value&...` string
        $paramString = implode('&', $pairs);

        // Return method + URL + parameter string, each percent-encoded
        return strtoupper($method).'&'.rawurlencode($url).'&'.rawurlencode($paramString);
    }

    /**
     * Sign a base string with HMAC-SHA1 and the OAuth signing key.
     *
     * @param string $baseString The signature base string.
     * @param string $consumerSecret
     * @param string $tokenSecret
     * @return string The base64-encoded signature.
     */
    public static function sign(string $baseString, string $consumerSecret, string $tokenSecret): string
    {
        // The signing key is the two secrets, percent-encoded and joined
        $signingKey = rawurlencode($consumerSecret).'&'.rawurlencode($tokenSecret);

        // Return the base64-encoded HMAC-SHA1 signature
        return base64_encode(hash_hmac('sha1', $baseString, $signingKey, true));
    }

}
