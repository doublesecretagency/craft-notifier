<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\base\Element;
use doublesecretagency\notifier\elements\conditions\NotificationCondition;
use doublesecretagency\notifier\elements\db\NotificationQuery;
use doublesecretagency\notifier\elements\Notification;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the Notification element type.
 *
 * Notification is a Craft element backed by the `notifier_notifications`
 * extension table. Its public surface is large (every Element override)
 * but the parts that matter for the plugin's behavior are: the
 * persisted attributes, the query / condition wiring, the permission
 * gates, and the task-recipient / dynamic-recipients validation.
 */
class NotificationElementTest extends TestCase
{
    private string $notificationSource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/elements/Notification.php';
        $this->assertTrue(file_exists($path), "Notification.php should exist at: $path");
        $this->notificationSource = file_get_contents($path);
        $this->reflection = new ReflectionClass(Notification::class);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testExtendsCraftElement(): void
    {
        $this->assertTrue($this->reflection->isSubclassOf(Element::class));
    }

    public function testRefHandle(): void
    {
        // `notification` is the reference handle used in Twig
        // (e.g. {notification:42:title}).
        $this->assertSame('notification', Notification::refHandle());
    }

    public function testHasContent(): void
    {
        $this->assertTrue(Notification::hasContent());
    }

    public function testHasTitles(): void
    {
        $this->assertTrue(Notification::hasTitles());
    }

    public function testHasStatuses(): void
    {
        $this->assertTrue(Notification::hasStatuses());
    }

    // ========================================================================= //
    // Persisted attributes
    // ========================================================================= //

    /**
     * @return string[][]
     */
    public static function persistedAttributeProvider(): array
    {
        return [
            ['description'],
            ['eventType'],
            ['event'],
            ['eventConfig'],
            ['messageType'],
            ['messageConfig'],
            ['recipientsType'],
            ['recipientsConfig'],
        ];
    }

    /**
     * @dataProvider persistedAttributeProvider
     */
    public function testPersistedAttributeIsPublicProperty(string $attribute): void
    {
        // Each attribute mapped from the `notifier_notifications` table row
        // must be a public property on the element so afterSave() can copy it.
        $this->assertTrue(
            $this->reflection->hasProperty($attribute),
            "Notification element should expose `$attribute` as a public property"
        );
        $this->assertTrue($this->reflection->getProperty($attribute)->isPublic());
    }

    // ========================================================================= //
    // Query / Condition wiring
    // ========================================================================= //

    public function testFindReturnsNotificationQuery(): void
    {
        // The custom query class is what enables Notification::find() to
        // expose the notification-specific filters.
        $this->assertStringContainsString(
            'NotificationQuery::class',
            $this->notificationSource
        );
        // and the import is wired up
        $this->assertStringContainsString(
            'use ' . NotificationQuery::class,
            $this->notificationSource
        );
    }

    public function testCreateConditionReturnsNotificationCondition(): void
    {
        $this->assertStringContainsString(
            'NotificationCondition::class',
            $this->notificationSource
        );
        $this->assertStringContainsString(
            'use ' . NotificationCondition::class,
            $this->notificationSource
        );
    }

    // ========================================================================= //
    // Permission gating
    // ========================================================================= //

    public function testCanViewChecksViewPermission(): void
    {
        // Non-admins must hold notifier-viewNotifications.
        $this->assertMatchesRegularExpression(
            "/canView[\s\S]*?'notifier-viewNotifications'/",
            $this->notificationSource
        );
    }

    public function testCanSaveChecksSavePermission(): void
    {
        $this->assertMatchesRegularExpression(
            "/canSave[\s\S]*?'notifier-saveNotifications'/",
            $this->notificationSource
        );
    }

    public function testCanDeleteChecksDeletePermission(): void
    {
        $this->assertMatchesRegularExpression(
            "/canDelete[\s\S]*?'notifier-deleteNotifications'/",
            $this->notificationSource
        );
    }

    public function testCanDuplicateChecksSavePermission(): void
    {
        // Duplicating creates a new notification; same permission as save.
        $this->assertMatchesRegularExpression(
            "/canDuplicate[\s\S]*?'notifier-saveNotifications'/",
            $this->notificationSource
        );
    }

    public function testCanCreateDraftsRequiresSavePermission(): void
    {
        // Creating a draft is an edit affordance — historically returned true
        // unconditionally, which let view-only users author drafts. Drafts
        // must now require notifier-saveNotifications, same as a fresh save.
        $this->assertMatchesRegularExpression(
            "/canCreateDrafts[\s\S]*?'notifier-saveNotifications'/",
            $this->notificationSource
        );
    }

    // ========================================================================= //
    // Dynamic Recipients server-side gate
    // ========================================================================= //

    public function testValidateDynamicRecipientsPermissionExists(): void
    {
        // Server-side gate on the Dynamic Recipients dropdown — the CP
        // template hides the option, but a crafted POST could bypass that.
        $this->assertTrue(
            $this->reflection->hasMethod('validateDynamicRecipientsPermission')
        );
        $this->assertTrue(
            $this->reflection->getMethod('validateDynamicRecipientsPermission')->isPublic()
        );
    }

    public function testValidateRulesIncludeDynamicRecipientsPermissionCheck(): void
    {
        // The validator must be wired into defineRules() so it actually runs.
        $this->assertStringContainsString(
            "'validateDynamicRecipientsPermission'",
            $this->notificationSource
        );
    }

    public function testValidateDynamicRecipientsBypassedForConsoleAndQueue(): void
    {
        // Console / queue / programmatic saves are trusted (no user identity
        // to check against). The validator must short-circuit when not in CP.
        $this->assertStringContainsString(
            'getIsCpRequest()',
            $this->notificationSource
        );
    }

    public function testValidateDynamicRecipientsChecksTheCorrectPermission(): void
    {
        // The permission name must exactly match what's registered in
        // NotifierPlugin::_registerUserPermissions().
        $this->assertStringContainsString(
            "'notifier-editDynamicRecipients'",
            $this->notificationSource
        );
    }

    // ========================================================================= //
    // afterSave persistence
    // ========================================================================= //

    public function testAfterSavePersistsAllAttributes(): void
    {
        // Each persisted attribute must be copied from POST or the element
        // onto the NotificationRecord so a refresh sees the latest state.
        foreach (self::persistedAttributeProvider() as [$attr]) {
            $this->assertStringContainsString(
                "\$record->$attr",
                $this->notificationSource,
                "afterSave should persist `$attr` to NotificationRecord"
            );
        }
    }

    // ========================================================================= //
    // Task recipient labels
    // ========================================================================= //

    public function testGetTaskRecipientCoversAllSixTypes(): void
    {
        // Used as the queue-job label for "Sending {messageType} to {recipient}".
        // Each of the six recipientsType values must yield a human-readable label.
        $this->assertMatchesRegularExpression("/case\s+'current-user'/", $this->notificationSource);
        $this->assertMatchesRegularExpression("/case\s+'all-users'/", $this->notificationSource);
        $this->assertMatchesRegularExpression("/case\s+'all-admins'/", $this->notificationSource);
        $this->assertMatchesRegularExpression("/case\s+'selected-groups'/", $this->notificationSource);
        $this->assertMatchesRegularExpression("/case\s+'selected-users'/", $this->notificationSource);
        $this->assertMatchesRegularExpression("/case\s+'dynamic-recipients'/", $this->notificationSource);
    }

    // ========================================================================= //
    // Plugin-facing send() entry point
    // ========================================================================= //

    public function testSendDelegatesToMessagesService(): void
    {
        // $notification->send($event) is the conventional in-Twig way to
        // re-fire a notification; it must hand off to the Messages service.
        $this->assertStringContainsString(
            '->messages->send($this, $event)',
            $this->notificationSource
        );
    }
}
