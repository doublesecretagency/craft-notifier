<?php
/**
 * Notifier plugin for Craft CMS
 *
 * Send custom Twig messages when Craft events are triggered.
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

namespace doublesecretagency\notifier\services;

use Craft;
use craft\base\Component;
use craft\elements\User;
use craft\helpers\ArrayHelper;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\models\Recipient;
use Throwable;

/**
 * Class Recipients
 * @since 1.0.0
 */
class Recipients extends Component
{

    /**
     * @var string|null
     */
    private ?string $_emailField = null;

    /**
     * @var string|null
     */
    private ?string $_smsField = null;

    /**
     * Get all selected recipients.
     *
     * @param Notification|null $notification
     * @return array
     */
    public function getRecipients(?Notification $notification = null): array
    {
        // Set field handles of User contact info
        $this->_emailField = ($notification->messageConfig['emailField'] ?? null);
        $this->_smsField   = ($notification->messageConfig['smsField']   ?? null);

        // Gather recipients based on type
        switch ($notification->recipientsType ?? null) {
            case 'current-user':       return $this->_currentUser();
            case 'all-users':          return $this->_allUsers();
            case 'all-admins':         return $this->_allAdmins();
            case 'selected-groups':    return ($notification ? $this->_selectedGroups($notification)    : []);
            case 'selected-users':     return ($notification ? $this->_selectedUsers($notification)     : []);
            case 'dynamic-recipients': return ($notification ? $this->_dynamicRecipients($notification) : []);
        }

        // Invalid recipients type
        return [];
    }

    // ========================================================================= //

    /**
     * Get user who triggered the Event.
     *
     * @return array
     */
    private function _currentUser(): array
    {
        // Attempt to get the currently active user
        try {
            $currentUser = Craft::$app->getUser()->getIdentity();
        } catch (Throwable $e) {
            $currentUser = null;
        }

        // If no current user
        if (!$currentUser) {
            // Return empty array
            return [];
        }

        // Return only the current User as a Recipient
        return $this->_convertToRecipients([$currentUser]);
    }

    /**
     * Get all Users.
     *
     * @return array
     */
    private function _allUsers(): array
    {
        // Get all users
        $users = User::find()->all();

        // Return the Users as Recipients
        return $this->_convertToRecipients($users);
    }

    /**
     * Get all Users with Admin privileges.
     *
     * @return array
     */
    private function _allAdmins(): array
    {
        // Get all Admin users
        $users = User::find()->admin()->all();

        // Return the Users as Recipients
        return $this->_convertToRecipients($users);
    }

    /**
     * Get all Users in selected User Group(s).
     *
     * @param Notification $notification
     * @return array
     */
    private function _selectedGroups(Notification $notification): array
    {
        // Get selected User Group IDs
        $groupIds = ($notification->recipientsConfig['userGroups'] ?? null);

        // If no User Group IDs, return empty array
        if (!$groupIds) {
            return [];
        }

        // If "All" was selected
        if ('*' === $groupIds) {
            // Get all User Groups
            $allGroups = Craft::$app->getUserGroups()->getAllGroups();
            // Get all User Group IDs
            $groupIds = ArrayHelper::getColumn($allGroups, 'id');
        }

        // Get all Users from selected User Groups
        $users = User::find()->groupId($groupIds)->all();

        // Return the Users as Recipients
        return $this->_convertToRecipients($users);
    }

    /**
     * Get only selected User(s).
     *
     * @param Notification $notification
     * @return array
     */
    private function _selectedUsers(Notification $notification): array
    {
        // Get selected User IDs
        $userIds = ($notification->recipientsConfig['users'] ?? null);

        // If no User IDs, return empty array
        if (!$userIds) {
            return [];
        }

        // Get selected Users
        $users = User::find()->id($userIds)->all();

        // Return the Users as Recipients
        return $this->_convertToRecipients($users);
    }

    /**
     * Get dynamic recipients.
     *
     * @param Notification $notification
     * @return array
     */
    private function _dynamicRecipients(Notification $notification): array
    {
        return [];
    }

    // ========================================================================= //

    /**
     * Convert an array of Users to Recipients.
     *
     * @param User[] $users
     * @return Recipient[]
     */
    private function _convertToRecipients(array $users): array
    {
        // Convert Users to Recipients
        array_walk($users,
            function (&$value) {
                $value = new Recipient([
                    'user'       => $value,
                    'emailField' => $this->_emailField,
                    'smsField'   => $this->_smsField,
                ]);
            }
        );

        // Return Users as Recipients
        return $users;
    }

}
