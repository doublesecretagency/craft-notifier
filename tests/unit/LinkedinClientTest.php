<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\helpers\LinkedinClient;
use PHPUnit\Framework\TestCase;

/**
 * Pure-unit tests for the LinkedinClient helper.
 *
 * Only authorizeUrl() is exercisable here, since it is a pure string builder
 * with no network call. The token exchange, refresh, userinfo, and post
 * methods all hit LinkedIn over Guzzle, so they are verified manually in the
 * sandbox against a real LinkedIn app.
 */
class LinkedinClientTest extends TestCase
{
    // ========================================================================= //
    // Scope constants
    // ========================================================================= //

    public function testMemberScopesIncludeMemberPostingAndOpenId(): void
    {
        // Member posting needs w_member_social; openid + profile identify the member.
        $this->assertContains('w_member_social', LinkedinClient::MEMBER_SCOPES);
        $this->assertContains('openid', LinkedinClient::MEMBER_SCOPES);
        $this->assertContains('profile', LinkedinClient::MEMBER_SCOPES);
    }

    public function testOrganizationScopeIsSeparate(): void
    {
        // Organization posting is an additional, separately-requested scope.
        $this->assertSame('w_organization_social', LinkedinClient::ORGANIZATION_SCOPE);
    }

    // ========================================================================= //
    // authorizeUrl
    // ========================================================================= //

    public function testAuthorizeUrlTargetsLinkedinAuthorizeEndpoint(): void
    {
        $url = LinkedinClient::authorizeUrl('client-123', 'https://example.test/callback', LinkedinClient::MEMBER_SCOPES, 'state-abc');
        $this->assertStringStartsWith('https://www.linkedin.com/oauth/v2/authorization?', $url);
    }

    public function testAuthorizeUrlCarriesAllRequiredParameters(): void
    {
        $url = LinkedinClient::authorizeUrl('client-123', 'https://example.test/callback', ['openid', 'profile'], 'state-abc');

        // Pull the query string apart to assert each parameter
        parse_str(parse_url($url, PHP_URL_QUERY), $params);

        $this->assertSame('code', $params['response_type']);
        $this->assertSame('client-123', $params['client_id']);
        $this->assertSame('https://example.test/callback', $params['redirect_uri']);
        $this->assertSame('state-abc', $params['state']);
        $this->assertSame('openid profile', $params['scope']);
    }

    // ========================================================================= //
    // fetchMember (source-level; the call hits LinkedIn's userinfo endpoint)
    // ========================================================================= //

    public function testFetchMemberReturnsUrnAndName(): void
    {
        // fetchMember must surface the member's display name from the userinfo
        // response (the `profile` scope provides it), not just the URN, so the
        // connection can be labeled with the real name. Source-level because the
        // method makes a network call and can't run under this protocol.
        $source = file_get_contents(dirname(__DIR__, 2) . '/src/helpers/LinkedinClient.php');

        $this->assertStringContainsString('public static function fetchMember(', $source);
        $this->assertStringContainsString("'urn'  => 'urn:li:person:'.\$decoded['sub']", $source);
        $this->assertStringContainsString("'name' => (string) (\$decoded['name']", $source);
    }

    // ========================================================================= //
    // Preview card: Open Graph parsing (pure, reflection-invoked)
    // ========================================================================= //

    /**
     * Invoke a private static method on LinkedinClient. The Open Graph parser
     * is pure (no Craft, no network), so it runs directly under this protocol.
     */
    private function _invoke(string $method, array $args)
    {
        $m = new \ReflectionMethod(\doublesecretagency\notifier\helpers\LinkedinClient::class, $method);
        $m->setAccessible(true);
        return $m->invokeArgs(null, $args);
    }

    public function testParseOpenGraphPrefersOgTitleOverTitleTag(): void
    {
        $html = '<title>Fallback</title><meta property="og:title" content="OG Title">';
        $this->assertSame('OG Title', $this->_invoke('_parseOpenGraph', [$html])['title']);
    }

    public function testParseOpenGraphFallsBackToTitleTag(): void
    {
        $html = '<title>Just the title tag</title>';
        $this->assertSame('Just the title tag', $this->_invoke('_parseOpenGraph', [$html])['title']);
    }

    public function testParseOpenGraphReadsReversedAttrOrderAndDecodesEntities(): void
    {
        // content-before-property attribute order, plus an HTML entity to decode
        $html = '<meta content="Tom &amp; Jerry" property="og:description">';
        $this->assertSame('Tom & Jerry', $this->_invoke('_parseOpenGraph', [$html])['description']);
    }

    public function testParseOpenGraphFallsBackToMetaDescription(): void
    {
        $html = '<meta name="description" content="plain meta desc">';
        $this->assertSame('plain meta desc', $this->_invoke('_parseOpenGraph', [$html])['description']);
    }

    public function testParseOpenGraphExtractsOgImage(): void
    {
        $html = '<meta property="og:image" content="https://example.com/card.jpg">';
        $this->assertSame('https://example.com/card.jpg', $this->_invoke('_parseOpenGraph', [$html])['image']);
    }

    public function testParseOpenGraphReturnsNullsWhenNothingPresent(): void
    {
        $r = $this->_invoke('_parseOpenGraph', ['<p>no meta here</p>']);
        $this->assertNull($r['title']);
        $this->assertNull($r['description']);
        $this->assertNull($r['image']);
    }

    public function testParseOpenGraphCapsTitleAndDescriptionToLinkedinLimits(): void
    {
        $html = '<meta property="og:title" content="'.str_repeat('a', 500).'">'
              . '<meta property="og:description" content="'.str_repeat('b', 5000).'">';
        $r = $this->_invoke('_parseOpenGraph', [$html]);
        $this->assertSame(400, mb_strlen($r['title']));
        $this->assertSame(4086, mb_strlen($r['description']));
    }

    // ========================================================================= //
    // Preview card: article + image upload (source-level)
    // ========================================================================= //

    public function testPostSendsLinkAsArticleContentNotCommentary(): void
    {
        // A link must be attached as a structured article (so LinkedIn renders a
        // preview card), not appended to the commentary as the old code did.
        $source = file_get_contents(dirname(__DIR__, 2) . '/src/helpers/LinkedinClient.php');
        $this->assertStringContainsString("\$payload['content'] = [", $source);
        $this->assertStringContainsString("'article' => static::_buildArticle(", $source);
        // The old commentary-append behavior is gone.
        $this->assertStringNotContainsString('str_contains($commentary, $link)', $source);
    }

    public function testBuildArticleFallsBackTitleToHost(): void
    {
        // When the page has no title, the article title falls back to the host.
        $source = file_get_contents(dirname(__DIR__, 2) . '/src/helpers/LinkedinClient.php');
        $this->assertStringContainsString('parse_url($url, PHP_URL_HOST)', $source);
    }

    public function testUploadImageInitializesThenPutsToLinkedin(): void
    {
        // The thumbnail flow: initializeUpload to get an upload URL + image URN,
        // then PUT the downloaded bytes; failures return null (no thumbnail).
        $source = file_get_contents(dirname(__DIR__, 2) . '/src/helpers/LinkedinClient.php');
        $this->assertStringContainsString('public static function uploadImage(', $source);
        $this->assertStringContainsString("IMAGES_URL.'?action=initializeUpload'", $source);
        $this->assertStringContainsString("'initializeUploadRequest' => ['owner' => \$authorUrn]", $source);
        $this->assertStringContainsString('$client->put($uploadUrl', $source);
    }

    public function testImagesUrlConstant(): void
    {
        $this->assertSame('https://api.linkedin.com/rest/images', \doublesecretagency\notifier\helpers\LinkedinClient::IMAGES_URL);
    }
}
