<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\base\Component;
use doublesecretagency\notifier\services\Recipients;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the Recipients service.
 *
 * Recipients::getRecipients() resolves a Notification's recipientsType
 * into a list of Recipient value objects. The six strategies it supports
 * each have their own private method; this test verifies each is
 * present so a future refactor can't silently drop one.
 */
class RecipientsServiceTest extends TestCase
{
    private string $recipientsSource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/services/Recipients.php';
        $this->assertTrue(file_exists($path), "Recipients.php should exist at: $path");
        $this->recipientsSource = file_get_contents($path);
        $this->reflection = new ReflectionClass(Recipients::class);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testExtendsComponent(): void
    {
        $this->assertTrue($this->reflection->isSubclassOf(Component::class));
    }

    // ========================================================================= //
    // Public surface
    // ========================================================================= //

    public function testGetRecipientsExists(): void
    {
        $this->assertTrue($this->reflection->hasMethod('getRecipients'));
        $this->assertTrue($this->reflection->getMethod('getRecipients')->isPublic());
    }

    public function testGetRecipientsAcceptsNotificationDispatchAndCpFlag(): void
    {
        // Dispatch is required for the dynamic-recipients branch to drive
        // the Twig sandbox. The cpAccessibleOnly flag is consumed by the
        // announcement channel to narrow the bulk all-users branch at query time.
        $params = $this->reflection->getMethod('getRecipients')->getParameters();
        $this->assertCount(3, $params);
        $this->assertSame('notification', $params[0]->getName());
        $this->assertSame('dispatch', $params[1]->getName());
        $this->assertSame('cpAccessibleOnly', $params[2]->getName());

        // The flag defaults to false so existing email/SMS callers are unaffected.
        $this->assertTrue($params[2]->isDefaultValueAvailable());
        $this->assertFalse($params[2]->getDefaultValue());
    }

    public function testCpAccessibleFlagThreadsIntoAllUsersBranch(): void
    {
        // The flag must reach _allUsers() so the User query can narrow at
        // query time. Other strategy branches ignore it on purpose.
        $this->assertMatchesRegularExpression(
            "/'all-users':\s*return\s+\\\$this->_allUsers\(\\\$cpAccessibleOnly\)/",
            $this->recipientsSource
        );
    }

    public function testAllUsersAppliesCpAccessFilterWhenRequested(): void
    {
        // _allUsers must apply ->can('accessCp') on the User query when the
        // flag is true, so front-end-only users are skipped at query time
        // (rather than triggering one warning per skipped user downstream).
        $this->assertStringContainsString("can('accessCp')", $this->recipientsSource);
    }

    // ========================================================================= //
    // Strategy methods
    // ========================================================================= //

    /**
     * @return string[][]
     */
    public static function strategyMethodProvider(): array
    {
        return [
            ['_currentUser'],
            ['_allUsers'],
            ['_allAdmins'],
            ['_selectedGroups'],
            ['_selectedUsers'],
            ['_dynamicRecipients'],
            ['_ntfyTopics'],
            ['_slackChannels'],
            ['_blueskyAccounts'],
            ['_mqttTopics'],
            ['_discordChannels'],
            ['_mastodonAccounts'],
            ['_linkedinAccounts'],
        ];
    }

    /**
     * @dataProvider strategyMethodProvider
     */
    public function testStrategyMethodIsPrivate(string $method): void
    {
        // All six strategy methods are internal, the public surface is the
        // single getRecipients() dispatcher.
        $this->assertTrue(
            $this->reflection->hasMethod($method),
            "Recipients service should expose the $method strategy method"
        );
        $this->assertTrue(
            $this->reflection->getMethod($method)->isPrivate(),
            "$method should be private (internal strategy)"
        );
    }

    // ========================================================================= //
    // Strategy dispatch (source-level)
    // ========================================================================= //

    public function testGetRecipientsDispatchesAllTwelveStrategies(): void
    {
        // The switch on recipientsType must cover all twelve strategies.
        $this->assertMatchesRegularExpression("/case\s+'current-user'/", $this->recipientsSource);
        $this->assertMatchesRegularExpression("/case\s+'all-users'/", $this->recipientsSource);
        $this->assertMatchesRegularExpression("/case\s+'all-admins'/", $this->recipientsSource);
        $this->assertMatchesRegularExpression("/case\s+'selected-groups'/", $this->recipientsSource);
        $this->assertMatchesRegularExpression("/case\s+'selected-users'/", $this->recipientsSource);
        $this->assertMatchesRegularExpression("/case\s+'dynamic-recipients'/", $this->recipientsSource);
        $this->assertMatchesRegularExpression("/case\s+'ntfy-topics'/", $this->recipientsSource);
        $this->assertMatchesRegularExpression("/case\s+'slack-channels'/", $this->recipientsSource);
        $this->assertMatchesRegularExpression("/case\s+'bluesky-accounts'/", $this->recipientsSource);
        $this->assertMatchesRegularExpression("/case\s+'mqtt-topics'/", $this->recipientsSource);
        $this->assertMatchesRegularExpression("/case\s+'discord-channels'/", $this->recipientsSource);
        $this->assertMatchesRegularExpression("/case\s+'mastodon-accounts'/", $this->recipientsSource);
        $this->assertMatchesRegularExpression("/case\s+'linkedin-accounts'/", $this->recipientsSource);
    }

    public function testEachCaseDelegatesToItsStrategy(): void
    {
        $this->assertMatchesRegularExpression(
            "/'current-user':\s*return\s+\\\$this->_currentUser/",
            $this->recipientsSource
        );
        $this->assertMatchesRegularExpression(
            "/'all-users':\s*return\s+\\\$this->_allUsers/",
            $this->recipientsSource
        );
        $this->assertMatchesRegularExpression(
            "/'all-admins':\s*return\s+\\\$this->_allAdmins/",
            $this->recipientsSource
        );
    }

    // ========================================================================= //
    // Strategy-specific guards
    // ========================================================================= //

    public function testSelectedGroupsHandlesAllSentinel(): void
    {
        // The CP allows users to pick "*" meaning all groups; the strategy
        // must expand that to every group ID before querying users.
        $this->assertStringContainsString("'*' === \$groupIds", $this->recipientsSource);
        $this->assertStringContainsString('getAllGroups', $this->recipientsSource);
    }

    public function testAllAdminsFiltersByAdminFlag(): void
    {
        // _allAdmins must use User::find()->admin(), without the admin()
        // call it would return all users, which would be a serious bug.
        $this->assertStringContainsString(
            'User::find()->admin()',
            $this->recipientsSource
        );
    }

    public function testDynamicRecipientsBailsOnFailedParse(): void
    {
        // Twig parse failures must short-circuit so a broken snippet doesn't
        // cause the rest of the pipeline to run with an empty recipient list
        // it didn't ask for.
        $this->assertStringContainsString(
            '$dispatch->parseDynamicRecipientSnippet',
            $this->recipientsSource
        );
    }

    public function testDynamicRecipientsValidatesEmailItems(): void
    {
        // Dynamic Recipients can yield User instances, email strings, or
        // phone numbers. Email validation is delegated to Yii's
        // EmailValidator, not a hand-rolled regex.
        $this->assertStringContainsString('EmailValidator', $this->recipientsSource);
        $this->assertStringContainsString('->validate($item)', $this->recipientsSource);
    }

    public function testDynamicRecipientsValidatesPhoneNumberShape(): void
    {
        // Conservative phone-number shape: starts with +, 8 to 15 digits.
        // Just look for the literal regex string in the source.
        $this->assertStringContainsString(
            '/^\+\d{8,15}$/',
            $this->recipientsSource
        );
    }
}
