<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\elements\User;
use craft\events\ModelEvent;
use craft\events\UserEvent;
use craft\events\UserGroupsAssignEvent;
use doublesecretagency\notifier\helpers\events\UserEvents;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use yii\base\Event;

/**
 * Structural tests for the UserEvents helper.
 *
 * Mirrors EntryEventsTest's shape, but covers the User-specific helper.
 * The Tier 1 expansion (issue #2) added afterUpdate, afterDelete, and
 * afterRestore alongside the original beforeSave/afterPropagate/
 * afterActivateUser surface. afterPropagate and afterUpdate both ride
 * User::EVENT_AFTER_PROPAGATE; the firstSave guard inside each handler
 * splits "new user" from "updated user" so the dispatch routes never
 * cross.
 */
class UserEventsTest extends TestCase
{
    private string $helperSource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/helpers/events/UserEvents.php';
        $this->assertTrue(file_exists($path), "UserEvents helper should exist at: $path");
        $this->helperSource = file_get_contents($path);
        $this->reflection = new ReflectionClass(UserEvents::class);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testLivesInHelpersEventsNamespace(): void
    {
        $this->assertSame(
            'doublesecretagency\notifier\helpers\events',
            $this->reflection->getNamespaceName()
        );
    }

    public function testImportsUserAndEventTypes(): void
    {
        // User for the sender type on element-level handlers; ModelEvent for
        // the element-class event handlers; UserEvent for the activate-user
        // service-level handler.
        $this->assertStringContainsString('use ' . User::class, $this->helperSource);
        $this->assertStringContainsString('use ' . ModelEvent::class, $this->helperSource);
        $this->assertStringContainsString('use ' . UserEvent::class, $this->helperSource);
    }

    // ========================================================================= //
    // Public method surface
    // ========================================================================= //

    /**
     * @return string[][]
     */
    public static function userEventMethodProvider(): array
    {
        return [
            ['beforeSave',           ModelEvent::class],
            ['afterPropagate',       ModelEvent::class],
            ['afterActivateUser',    UserEvent::class],
            ['afterUpdate',          ModelEvent::class],
            ['afterAssignToGroups',  UserGroupsAssignEvent::class],
            ['afterDelete',          Event::class],
            ['afterRestore',         Event::class],
        ];
    }

    /**
     * @dataProvider userEventMethodProvider
     */
    public function testMethodIsPublicStaticVoid(string $method): void
    {
        $this->assertTrue($this->reflection->hasMethod($method));
        $reflectionMethod = $this->reflection->getMethod($method);
        $this->assertTrue($reflectionMethod->isPublic());
        $this->assertTrue($reflectionMethod->isStatic());
        $this->assertSame('void', (string) $reflectionMethod->getReturnType());
    }

    /**
     * @dataProvider userEventMethodProvider
     */
    public function testMethodAcceptsExpectedEventType(string $method, string $eventClass): void
    {
        $params = $this->reflection->getMethod($method)->getParameters();
        $this->assertCount(1, $params);
        $this->assertSame('event', $params[0]->getName());
        $this->assertSame($eventClass, (string) $params[0]->getType());
    }

    // ========================================================================= //
    // beforeSave: original-user capture
    // ========================================================================= //

    public function testBeforeSaveBypassesElementCacheWithIgnorePlaceholders(): void
    {
        // Same rationale as EntryEvents: ignorePlaceholders() prevents Craft's
        // in-memory cache from returning the post-save user instance.
        $this->assertMatchesRegularExpression(
            '/beforeSave[\s\S]*?ignorePlaceholders\(\)/',
            $this->helperSource
        );
    }

    public function testBeforeSaveEagerLoadsFieldValues(): void
    {
        // Eager field-value load pins the pre-save state into the original's
        // instance-local cache so later template reads of `original.field`
        // do not lazily fetch post-save content.
        $this->assertMatchesRegularExpression(
            '/beforeSave[\s\S]*?getFieldValues\(\)/',
            $this->helperSource
        );
    }

    // ========================================================================= //
    // Propagate vs update: firstSave split
    // ========================================================================= //

    public function testAfterPropagateGuardsOnFirstSave(): void
    {
        // The new-user dispatch must only fire when firstSave is true.
        // Without this guard, every user update would also trigger the
        // "new user created" notification.
        $this->assertMatchesRegularExpression(
            '/afterPropagate[\s\S]*?!\$user->firstSave[\s\S]*?return/',
            $this->helperSource
        );
    }

    public function testAfterUpdateGuardsOnNotFirstSave(): void
    {
        // The inverse guard: afterUpdate bails when firstSave is true so the
        // user-created flow does not also fire user-updated. Both handlers
        // share EVENT_AFTER_PROPAGATE; the split lives in these two guards.
        $this->assertMatchesRegularExpression(
            '/afterUpdate[\s\S]*?if\s*\(\s*\$user->firstSave\s*\)[\s\S]*?return/',
            $this->helperSource
        );
    }

    public function testAfterUpdateSkipsActivationFlow(): void
    {
        // Activation saves the user with pending flipping from true to false
        // before firing EVENT_AFTER_ACTIVATE_USER. Without this guard, the
        // same activation would dispatch both after-update AND after-activate-user.
        // Detect the activation-shaped save by comparing the captured original's
        // pending flag against the post-save user.
        $this->assertMatchesRegularExpression(
            '/afterUpdate[\s\S]*?\$original->pending[\s\S]*?!\$user->pending[\s\S]*?return/',
            $this->helperSource
        );
    }

    // ========================================================================= //
    // Notification query event filters (per-handler)
    // ========================================================================= //

    /**
     * @return string[][]
     */
    public static function notificationEventValueProvider(): array
    {
        return [
            ['afterPropagate',       'after-propagate'],
            ['afterActivateUser',    'after-activate-user'],
            ['afterUpdate',          'after-update'],
            ['afterAssignToGroups',  'after-assign-to-groups'],
            ['afterDelete',          'after-delete'],
            ['afterRestore',         'after-restore'],
        ];
    }

    /**
     * @dataProvider notificationEventValueProvider
     */
    public function testHandlerQueriesNotificationsByEventValue(string $method, string $eventValue): void
    {
        // Each handler queries Notification rows whose `event` column matches
        // the dropdown value the user picked in the CP. These value strings
        // are persisted to the database, so renaming them is a breaking change.
        $this->assertMatchesRegularExpression(
            sprintf(
                '/%s[\s\S]*?\'event\'\s*=>\s*\'%s\'/',
                preg_quote($method, '/'),
                preg_quote($eventValue, '/')
            ),
            $this->helperSource
        );
    }

    /**
     * @dataProvider notificationEventValueProvider
     */
    public function testHandlerScopesQueryToUsersEventType(string $method): void
    {
        // Every UserEvents handler must scope the Notification query to the
        // 'users' eventType so it cannot pick up dispatch rows belonging to
        // entries / assets / craft-commerce-orders.
        $this->assertMatchesRegularExpression(
            sprintf(
                '/%s[\s\S]*?\'eventType\'\s*=>\s*\'users\'/',
                preg_quote($method, '/')
            ),
            $this->helperSource
        );
    }

    // ========================================================================= //
    // afterAssignToGroups: service event handling
    // ========================================================================= //

    public function testAfterAssignToGroupsHydratesUserFromUserId(): void
    {
        // UserGroupsAssignEvent carries `userId`, not the User element directly.
        // The handler must hydrate via Craft::$app->getUsers()->getUserById($event->userId)
        // before passing the user downstream.
        $this->assertMatchesRegularExpression(
            '/afterAssignToGroups[\s\S]*?getUserById\(\$event->userId\)/',
            $this->helperSource
        );
    }

    public function testAfterAssignToGroupsPassesNewGroupIdsInData(): void
    {
        // The Dispatch filter for this event reads `data['newGroupIds']` to
        // gate on newly-assigned overlap with the configured groups. The
        // handler must populate that data key.
        $this->assertMatchesRegularExpression(
            '/afterAssignToGroups[\s\S]*?\'newGroupIds\'\s*=>\s*\$event->newGroupIds/',
            $this->helperSource
        );
    }

    public function testAfterAssignToGroupsPassesUserAsObject(): void
    {
        // Twig templates and Dispatch's _matchEventCondition both read the
        // element from data['object']. For service events that don't fire on
        // the element directly, the handler must seed this key.
        $this->assertMatchesRegularExpression(
            '/afterAssignToGroups[\s\S]*?\'object\'\s*=>\s*\$user/',
            $this->helperSource
        );
    }
}
