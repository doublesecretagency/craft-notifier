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

namespace doublesecretagency\notifier\migrations;

use Craft;
use craft\db\Migration;
use craft\db\Query;
use craft\db\Table;
use craft\services\UserPermissions;

/**
 * Grants the new wiring-tab permissions to everyone who can save notifications.
 *
 * @since 3.2.0
 */
class m260711_130000_grant_wiring_tab_permissions extends Migration
{

    /**
     * @var string The parent permission whose holders are granted the new children (stored lowercased).
     */
    private const PARENT = 'notifier-savenotifications';

    /**
     * @var string The permission which the parent is nested under (stored lowercased).
     */
    private const ANCESTOR = 'notifier-viewnotifications';

    /**
     * @var string[] The new wiring-tab permissions to grant.
     */
    private const CHILDREN = [
        'notifier-editEventTab',
        'notifier-editMessageTab',
        'notifier-editRecipientsTab',
    ];

    /**
     * @inheritdoc
     */
    public function safeUp(): bool
    {
        // Get the user permissions service
        $userPermissions = Craft::$app->getUserPermissions();

        // Grant the group permissions (project config writes, writable environments only)
        $this->_grantGroupPermissions($userPermissions);

        // Grant the user permissions (database writes, safe on read-only too)
        $this->_grantUserPermissions($userPermissions);

        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown(): bool
    {
        echo "m260711_130000_grant_wiring_tab_permissions cannot be reverted.\n";
        return false;
    }

    // ========================================================================= //

    /**
     * Grant the wiring-tab permissions to every group that holds the parent.
     *
     * Group permissions live in project config. When a group's children are already in
     * the deployed config (a staging/production deploy), skip it and let project config
     * apply deliver them. Otherwise grant. This discriminates on config presence, not
     * `readOnly`, because Craft lifts `readOnly` during migrations when config is pending.
     *
     * @param UserPermissions $userPermissions The user permissions service.
     * @return void
     */
    private function _grantGroupPermissions(UserPermissions $userPermissions): void
    {
        // Get the project config service
        $pc = Craft::$app->getProjectConfig();

        // Loop through every user group
        foreach (Craft::$app->getUserGroups()->getAllGroups() as $group) {

            // Get the group's permissions from the deployed config
            $deployed = ($pc->get('users.groups.'.$group->uid.'.permissions', true) ?? []);

            // If the children are already deployed, skip (project config apply delivers them)
            if ($this->_hasAllChildren($deployed)) {
                continue;
            }

            // Get the group's current permissions
            $current = $userPermissions->getPermissionsByGroupId($group->id);

            // Merge in the children
            $merged = $this->_mergeChildren($current);

            // If nothing changed, skip
            if (null === $merged) {
                continue;
            }

            // If the group can't be saved without losing permissions, skip
            if (!$this->_hasAncestor($current)) {
                Craft::warning("Notifier: skipped granting wiring-tab permissions to user group {$group->id}, because it holds ".self::PARENT." without ".self::ANCESTOR.". Saving it would have removed the parent permission.", __METHOD__);
                continue;
            }

            // Save the permissions
            $userPermissions->saveGroupPermissions($group->id, $merged);
        }
    }

    /**
     * Grant the wiring-tab permissions to every user that holds the parent directly.
     *
     * User permissions live in the database, not project config, so they are never
     * delivered by config apply. Always grant them; saveUserPermissions() is a plain
     * database write, safe even on a read-only environment.
     *
     * @param UserPermissions $userPermissions The user permissions service.
     * @return void
     */
    private function _grantUserPermissions(UserPermissions $userPermissions): void
    {
        // Find every user that holds saveNotifications directly
        $userIds = (new Query())
            ->select(['upu.userId'])
            ->from(['upu' => Table::USERPERMISSIONS_USERS])
            ->innerJoin(['up' => Table::USERPERMISSIONS], '[[up.id]] = [[upu.permissionId]]')
            ->where(['up.name' => self::PARENT])
            ->column();

        // Loop through those users
        foreach (array_unique($userIds) as $userId) {

            // Cast the user ID to an integer
            $userId = (int) $userId;

            // Get the user's DIRECT permissions only, since the service's combined read
            // would also include group-inherited ones, which must not be copied to direct
            $current = (new Query())
                ->select(['up.name'])
                ->from(['up' => Table::USERPERMISSIONS])
                ->innerJoin(['upu' => Table::USERPERMISSIONS_USERS], '[[upu.permissionId]] = [[up.id]]')
                ->where(['upu.userId' => $userId])
                ->column();

            // Merge in the children
            $merged = $this->_mergeChildren($current);

            // If nothing changed, skip
            if (null === $merged) {
                continue;
            }

            // Get the permissions inherited from the user's groups
            $inherited = $userPermissions->getGroupPermissionsByUserId($userId);

            // If the user can't be saved without losing permissions, skip
            if (!$this->_hasAncestor(array_merge($current, $inherited))) {
                Craft::warning("Notifier: skipped granting wiring-tab permissions to user {$userId}, because they hold ".self::PARENT." without ".self::ANCESTOR.". Saving it would have removed the parent permission.", __METHOD__);
                continue;
            }

            // Save the permissions
            $userPermissions->saveUserPermissions($userId, $merged);
        }
    }

    /**
     * Whether a permission set holds the ancestor the parent is nested under.
     *
     * Craft's saveGroupPermissions/saveUserPermissions filter out any permission whose
     * ancestor is absent, so saving a set without it would delete the parent instead of
     * adding the children.
     *
     * @param string[] $permissions The permissions to check.
     * @return bool
     */
    private function _hasAncestor(array $permissions): bool
    {
        // Lowercase the permissions for comparison, since Craft stores them lowercased
        $lower = array_map('strtolower', $permissions);

        // Whether the ancestor is held
        return in_array(self::ANCESTOR, $lower, true);
    }

    /**
     * Whether a permission set already holds every wiring-tab child.
     *
     * Used to detect a deploy: when a group's deployed config already carries the
     * children, the migration skips it and lets project config apply deliver them.
     *
     * @param string[] $permissions The permissions to check.
     * @return bool
     */
    private function _hasAllChildren(array $permissions): bool
    {
        // Lowercase the permissions for comparison, since Craft stores them lowercased
        $lower = array_map('strtolower', $permissions);

        // Loop through each child permission
        foreach (self::CHILDREN as $child) {
            // If any child is missing, bail
            if (!in_array(strtolower($child), $lower, true)) {
                return false;
            }
        }

        // Every child is held
        return true;
    }

    /**
     * Merge the new children into a permission set that holds the parent.
     *
     * @param string[] $current The user/group's current permissions.
     * @return string[]|null The merged set, or null when no change is needed.
     */
    private function _mergeChildren(array $current): ?array
    {
        // Lowercase the current permissions for comparison, since Craft stores them lowercased
        $lower = array_map('strtolower', $current);

        // If the user/group doesn't hold the parent, nothing to grant
        if (!in_array(self::PARENT, $lower, true)) {
            return null;
        }

        // Initialize the merged permissions
        $merged = $current;

        // Loop through each child permission
        foreach (self::CHILDREN as $child) {

            // If the user/group doesn't already hold it
            if (!in_array(strtolower($child), $lower, true)) {
                // Add the child permission
                $merged[] = $child;
            }
        }

        // If nothing was added, no change is needed
        if (count($merged) === count($current)) {
            return null;
        }

        // Return the merged set
        return $merged;
    }

}
