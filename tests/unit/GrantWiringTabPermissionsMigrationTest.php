<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\db\Migration;
use doublesecretagency\notifier\migrations\m260711_130000_grant_wiring_tab_permissions as GrantMigration;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the wiring-tab permission-grant migration.
 *
 * Splitting saveNotifications narrows its meaning, so every principal holding
 * it must also receive the three new wiring-tab permissions or their edit
 * access silently regresses. These tests pin the read-merge-write grant and
 * the direct-vs-group permission handling.
 */
class GrantWiringTabPermissionsMigrationTest extends TestCase
{
    private string $source;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/migrations/m260711_130000_grant_wiring_tab_permissions.php';
        $this->assertTrue(file_exists($path), "Migration should exist at: $path");
        $this->source = file_get_contents($path);
        $this->reflection = new ReflectionClass(GrantMigration::class);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testExtendsMigration(): void
    {
        $this->assertTrue($this->reflection->isSubclassOf(Migration::class));
    }

    public function testGrantsAllThreeWiringPermissions(): void
    {
        // All three children must be in the grant set.
        $this->assertStringContainsString("'notifier-editEventTab'", $this->source);
        $this->assertStringContainsString("'notifier-editMessageTab'", $this->source);
        $this->assertStringContainsString("'notifier-editRecipientsTab'", $this->source);
    }

    public function testMatchesParentPermissionLowercased(): void
    {
        // Craft stores permission names lowercased, so the parent match must use
        // the lowercased handle.
        $this->assertStringContainsString("'notifier-savenotifications'", $this->source);
    }

    // ========================================================================= //
    // Grant mechanics
    // ========================================================================= //

    public function testUsesUserPermissionsServiceForGroups(): void
    {
        // Read-merge-write via the service (which normalizes casing and rewrites
        // the join tables) rather than hand-rolled INSERTs.
        $this->assertMatchesRegularExpression(
            '/getPermissionsByGroupId\([\s\S]*?saveGroupPermissions\(/',
            $this->source
        );
    }

    public function testReadsDirectUserPermissionsOnly(): void
    {
        // getPermissionsByUserId would include group-inherited permissions, which
        // must not be copied into a user's direct assignments. The migration
        // queries the direct join table instead, then saveUserPermissions.
        $this->assertStringNotContainsString('getPermissionsByUserId', $this->source);
        $this->assertMatchesRegularExpression(
            '/Table::USERPERMISSIONS_USERS[\s\S]*?saveUserPermissions\(/',
            $this->source
        );
    }

    public function testDedupesBeforeGranting(): void
    {
        // A principal that already holds a child must not get a duplicate row.
        $this->assertMatchesRegularExpression(
            '/in_array\(strtolower\(\$child\)/',
            $this->source
        );
    }

    // ========================================================================= //
    // Deploy-path safety: discriminate on config presence, not readOnly
    // ========================================================================= //
    //
    // Group permissions are project config; user permissions are database-only. The two
    // stores behave oppositely on a deploy, and neither may use `readOnly` to decide,
    // because Craft lifts readOnly during migrations when config is pending.
    //
    //   GROUP loop: skip a group whose children are already in the deployed config
    //   (a deploy; project config apply delivers them). Match migration 1's approach.
    //
    //   USER loop: always run. User permissions are not in project config, so config
    //   apply never delivers them; this is the sole delivery path, and it is a safe DB
    //   write.

    public function testGroupLoopDiscriminatesOnDeployedConfigNotReadOnly(): void
    {
        // The group method must consult the deployed config (get(..., true)) and skip
        // via _hasAllChildren, not branch on readOnly.
        $this->assertMatchesRegularExpression(
            "/function _grantGroupPermissions[\s\S]*?get\('users\.groups\.'\.\\\$group->uid\.'\.permissions',\s*true\)[\s\S]*?_hasAllChildren\([\s\S]*?continue;[\s\S]*?saveGroupPermissions\(/",
            $this->source
        );
        $this->assertDoesNotMatchRegularExpression(
            '/function _grantGroupPermissions[\s\S]*?->readOnly/',
            $this->source
        );
    }

    public function testUserLoopAlwaysRunsNoDiscriminator(): void
    {
        // The user method is the sole delivery path for user permissions (DB-only), so it
        // must NOT carry a readOnly OR a config-presence early-return.
        $this->assertMatchesRegularExpression(
            '/function _grantUserPermissions\(.*?\): void\s*\{(?:(?!function ).)*?saveUserPermissions\(/s',
            $this->source
        );
        $this->assertDoesNotMatchRegularExpression(
            '/function _grantUserPermissions[\s\S]*?(readOnly|_hasAllChildren)[\s\S]*?saveUserPermissions\(/',
            $this->source
        );
    }

    public function testNoBehaviorDiscriminationOnReadOnly(): void
    {
        // The 2026-07-20 bug: readOnly is unreliable inside a migration. Neither loop may
        // branch behavior on it.
        $this->assertStringNotContainsString('->readOnly', $this->source);
    }

    public function testGrantIsSplitIntoGroupAndUserMethods(): void
    {
        // safeUp delegates to the two methods so their differing deploy behavior is
        // explicit, not buried in one flat loop pair.
        $this->assertMatchesRegularExpression(
            '/function safeUp[\s\S]*?_grantGroupPermissions\([\s\S]*?_grantUserPermissions\(/',
            $this->source
        );
    }

    // ========================================================================= //
    // Orphaned-permission guard
    // ========================================================================= //
    //
    // Regression coverage for a bug found 2026-07-20 while testing the migration on
    // Craft 4 and Craft 5. A user group holding saveNotifications WITHOUT its ancestor
    // viewNotifications had saveNotifications DELETED by this migration.
    //
    // Craft's saveGroupPermissions()/saveUserPermissions() both run
    // _filterOrphanedPermissions(), which walks the registered permission tree from the
    // top and only descends into a `nested` block when the ancestor is in the posted
    // set. saveNotifications is nested under viewNotifications, so for an orphaned
    // principal the whole branch is filtered away and the save writes an empty set.
    //
    // The fix skips those principals entirely rather than granting the ancestor, since a
    // migration must never silently widen access. They are logged instead.

    public function testDeclaresTheAncestorPermission(): void
    {
        // The ancestor must be matched lowercased, the way Craft stores it.
        $this->assertStringContainsString("'notifier-viewnotifications'", $this->source);
    }

    public function testSkipsGroupsMissingTheAncestor(): void
    {
        // The group loop must consult the ancestor guard before saving.
        $this->assertMatchesRegularExpression(
            '/_hasAncestor\([\s\S]*?continue;[\s\S]*?saveGroupPermissions\(/',
            $this->source
        );
    }

    public function testSkipsUsersMissingTheAncestor(): void
    {
        // The user loop must consult the ancestor guard before saving.
        $this->assertMatchesRegularExpression(
            '/_hasAncestor\([\s\S]*?continue;[\s\S]*?saveUserPermissions\(/',
            $this->source
        );
    }

    public function testCountsGroupInheritedAncestorForUsers(): void
    {
        // saveUserPermissions passes the user's group permissions into the filter, so an
        // ancestor held via a group is enough. The guard must consider inherited
        // permissions or it would skip users who are perfectly safe to save.
        $this->assertStringContainsString('getGroupPermissionsByUserId', $this->source);
        $this->assertMatchesRegularExpression(
            '/_hasAncestor\(array_merge\(\$current, \$inherited\)\)/',
            $this->source
        );
    }

    public function testLogsWhenSkipping(): void
    {
        // A silent skip would be as hard to diagnose as the original silent deletion.
        $this->assertMatchesRegularExpression(
            '/Craft::warning\([\s\S]*?skipped granting wiring-tab permissions/',
            $this->source
        );
    }

    public function testDoesNotGrantTheAncestorToFixTheOrphan(): void
    {
        // Adding the ancestor would make the set survive the filter, but it would also
        // hand the principal a permission they never had. The guard must skip, not widen.
        $this->assertStringNotContainsString('$merged[] = self::ANCESTOR', $this->source);
        $this->assertDoesNotMatchRegularExpression(
            '/CHILDREN\s*=\s*\[[^\]]*viewNotifications/i',
            $this->source
        );
    }
}
