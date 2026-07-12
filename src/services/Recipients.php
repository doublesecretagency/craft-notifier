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

namespace doublesecretagency\notifier\services;

use Craft;
use craft\base\Component;
use craft\elements\User;
use craft\helpers\ArrayHelper;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\models\Dispatch;
use doublesecretagency\notifier\models\Recipient;
use doublesecretagency\notifier\NotifierPlugin;
use Throwable;
use yii\validators\EmailValidator;

/**
 * Resolves who should receive a notification.
 *
 * @since 1.0.0
 */
class Recipients extends Component
{

    /**
     * @var string|null Handle of the User field holding an email address.
     */
    private ?string $_emailField = null;

    /**
     * @var string|null Handle of the User field holding a phone number.
     */
    private ?string $_smsField = null;

    /**
     * Get all selected recipients.
     *
     * @param Notification|null $notification
     * @param Dispatch|null $dispatch Data for parsing Dynamic Recipients snippets.
     * @param bool $cpAccessibleOnly Prevent sending Announcements to non-CP users.
     *
     * @return array
     */
    public function getRecipients(?Notification $notification = null, ?Dispatch $dispatch = null, bool $cpAccessibleOnly = false): array
    {
        // Set field handles of User contact info
        $this->_emailField = ($notification->messageConfig['emailField'] ?? null);
        $this->_smsField   = ($notification->messageConfig['smsField']   ?? null);

        // Gather recipients based on type
        switch ($notification->recipientsType ?? null) {
            case 'current-user':       return $this->_currentUser();
            case 'all-users':          return $this->_allUsers($cpAccessibleOnly);
            case 'all-admins':         return $this->_allAdmins();
            case 'selected-groups':    return ($notification ? $this->_selectedGroups($notification)    : []);
            case 'selected-users':     return ($notification ? $this->_selectedUsers($notification)     : []);
            case 'dynamic-recipients': return ($notification ? $this->_dynamicRecipients($notification, $dispatch) : []);
            case 'ntfy-topics':        return ($notification ? $this->_ntfyTopics($notification)        : []);
            case 'slack-channels':     return ($notification ? $this->_slackChannels($notification)     : []);
            case 'discord-channels':   return ($notification ? $this->_discordChannels($notification)  : []);
            case 'facebook-pages':     return ($notification ? $this->_facebookPages($notification)     : []);
            case 'instagram-accounts': return ($notification ? $this->_instagramAccounts($notification) : []);
            case 'x-twitter-accounts': return ($notification ? $this->_xTwitterAccounts($notification)  : []);
            case 'bluesky-accounts':   return ($notification ? $this->_blueskyAccounts($notification)   : []);
            case 'mastodon-accounts':  return ($notification ? $this->_mastodonAccounts($notification) : []);
            case 'linkedin-accounts':  return ($notification ? $this->_linkedinAccounts($notification) : []);
            case 'mqtt-topics':        return ($notification ? $this->_mqttTopics($notification)        : []);
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

        // If no current user, return empty array
        if (!$currentUser) {
            return [];
        }

        // Return only the current User as a Recipient
        return $this->_convertToRecipients([$currentUser]);
    }

    /**
     * Get all Users.
     *
     * @param bool $cpAccessibleOnly Prevent sending Announcements to non-CP users.
     * @return array
     */
    private function _allUsers(bool $cpAccessibleOnly = false): array
    {
        // Build the User query
        $query = User::find();

        // Narrow to CP-accessible users when requested
        if ($cpAccessibleOnly) {
            $query->can('accessCp');
        }

        // Get all matching users
        $users = $query->all();

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
     * Get dynamic recipients by running the Notification's authored Twig snippet.
     *
     * The Dispatch owns the sandbox and runs the Twig parse; this method builds
     * a Recipient from each collected item and logs empty or unrecognized results.
     *
     * @param Notification $notification
     * @param Dispatch|null $dispatch Data for parsing Dynamic Recipients snippets.
     * @return Recipient[]
     */
    private function _dynamicRecipients(Notification $notification, ?Dispatch $dispatch = null): array
    {
        // If no dispatch was passed, bail
        if (!$dispatch) {
            return [];
        }

        // Parse the snippet; if parsing failed, bail
        if (!$dispatch->parseDynamicRecipientSnippet($notification)) {
            return [];
        }

        // If setRecipients was never invoked, log a warning and bail
        if (!$dispatch->setRecipientsInvoked) {
            $notification->log->warning(
                Craft::t('notifier', '[NO RECIPIENTS] The Dynamic Recipients snippet did not call setRecipients.'),
                $dispatch->runEnvelope()
            );
            return [];
        }

        // Get the items collected by the `{% setRecipients %}` calls
        $items = $dispatch->collectedDynamicRecipients;

        // If setRecipients was called with an empty value, log a warning and bail
        if (!$items) {
            $notification->log->warning(
                Craft::t('notifier', '[NO RECIPIENTS] setRecipients was called with an empty value.'),
                $dispatch->runEnvelope()
            );
            return [];
        }

        // Initialize the resolved recipients
        $recipients = [];

        // Build the email validator
        $emailValidator = new EmailValidator();

        // Loop through all collected items
        foreach ($items as $item) {

            // If item is a User, build a User-derived Recipient
            if ($item instanceof User) {
                $recipients[] = new Recipient([
                    'user'       => $item,
                    'emailField' => $this->_emailField,
                    'smsField'   => $this->_smsField,
                ]);
                continue;
            }

            // If item is not a string, log a warning and skip it
            if (!is_string($item)) {
                // Mint an envelope for the invalid recipient so the skip nests under it
                $envelopeId = $notification->log->envelope(
                    ['messageType' => $this->_messageTypeLabel($notification), 'recipient' => Craft::t('notifier', '[invalid recipient]')],
                    []
                );

                // Log the skip under the envelope
                $notification->log->warning(Craft::t('notifier',
                    '[SKIPPED] Unrecognized recipient of type "{type}".',
                    ['type' => get_debug_type($item)]
                ), $envelopeId);
                continue;
            }

            // If item validates as an email address, build an email Recipient
            if ($emailValidator->validate($item)) {
                $recipients[] = new Recipient([
                    'emailAddress' => $item,
                ]);
                continue;
            }

            // If item matches a conservative phone-number shape, build a phone Recipient
            if (preg_match('/^\+\d{8,15}$/', $item)) {
                $recipients[] = new Recipient([
                    'phoneNumber' => $item,
                ]);
                continue;
            }

            // Otherwise, mint an envelope for the invalid recipient and log the skip under it
            $envelopeId = $notification->log->envelope(
                ['messageType' => $this->_messageTypeLabel($notification), 'recipient' => Craft::t('notifier', '[invalid recipient]')],
                []
            );
            $notification->log->warning(Craft::t('notifier',
                '[SKIPPED] Unrecognized recipient "{value}".',
                ['value' => $item]
            ), $envelopeId);
        }

        // Return the resolved recipients
        return $recipients;
    }

    // ========================================================================= //

    /**
     * Get ntfy topic recipients by resolving selected UIDs against the named-list in plugin settings.
     *
     * @param Notification $notification
     * @return Recipient[]
     */
    private function _ntfyTopics(Notification $notification): array
    {
        return $this->_resolveByUid(
            $notification,
            'ntfyTopicUids',
            NotifierPlugin::$plugin->getSettings()->ntfyTopics,
            'ntfy topic',
            static function (array $row): Recipient {
                return new Recipient([
                    'name'  => $row['label'] ?? null,
                    'topic' => $row['topic'] ?? null,
                ]);
            }
        );
    }

    /**
     * Get Slack channel recipients by resolving selected UIDs against the named-list in plugin settings.
     *
     * @param Notification $notification
     * @return Recipient[]
     */
    private function _slackChannels(Notification $notification): array
    {
        return $this->_resolveByUid(
            $notification,
            'slackChannelUids',
            NotifierPlugin::$plugin->getSettings()->slackChannels,
            'Slack channel',
            static function (array $row): Recipient {
                return new Recipient([
                    'name'              => $row['label'] ?? null,
                    'slackChannelLabel' => $row['label'] ?? null,
                    'slackBotToken'     => $row['botToken'] ?? null,
                    'slackChannelId'    => $row['channelId'] ?? null,
                ]);
            }
        );
    }

    /**
     * Get Discord channel recipients by resolving selected UIDs against the named-list in plugin settings.
     *
     * @param Notification $notification
     * @return Recipient[]
     */
    private function _discordChannels(Notification $notification): array
    {
        return $this->_resolveByUid(
            $notification,
            'discordChannelUids',
            NotifierPlugin::$plugin->getSettings()->discordChannels,
            'Discord channel',
            static function (array $row): Recipient {
                return new Recipient([
                    'name'                => $row['label'] ?? null,
                    'discordChannelLabel' => $row['label'] ?? null,
                    'discordWebhookUrl'   => $row['webhookUrl'] ?? null,
                ]);
            }
        );
    }

    /**
     * Get Facebook page recipients by resolving selected UIDs against the named-list in plugin settings.
     *
     * @param Notification $notification
     * @return Recipient[]
     */
    private function _facebookPages(Notification $notification): array
    {
        return $this->_resolveByUid(
            $notification,
            'facebookPageUids',
            NotifierPlugin::$plugin->getSettings()->facebookPages,
            'Facebook page',
            static function (array $row): Recipient {
                return new Recipient([
                    'name'                    => $row['label'] ?? null,
                    'facebookPageLabel'       => $row['label'] ?? null,
                    'facebookPageId'          => $row['pageId'] ?? null,
                    'facebookPageAccessToken' => $row['pageAccessToken'] ?? null,
                ]);
            }
        );
    }

    /**
     * Get Instagram account recipients by resolving selected UIDs against the named-list in plugin settings.
     *
     * @param Notification $notification
     * @return Recipient[]
     */
    private function _instagramAccounts(Notification $notification): array
    {
        return $this->_resolveByUid(
            $notification,
            'instagramAccountUids',
            NotifierPlugin::$plugin->getSettings()->instagramAccounts,
            'Instagram account',
            static function (array $row): Recipient {
                return new Recipient([
                    'name'                     => $row['label'] ?? null,
                    'instagramAccountLabel'    => $row['label'] ?? null,
                    'instagramPageId'          => $row['pageId'] ?? null,
                    'instagramIgUserId'        => $row['igUserId'] ?? null,
                    'instagramPageAccessToken' => $row['pageAccessToken'] ?? null,
                ]);
            }
        );
    }

    /**
     * Get X (Twitter) account recipients by resolving selected UIDs against the named-list in plugin settings.
     *
     * @param Notification $notification
     * @return Recipient[]
     */
    private function _xTwitterAccounts(Notification $notification): array
    {
        return $this->_resolveByUid(
            $notification,
            'xTwitterAccountUids',
            NotifierPlugin::$plugin->getSettings()->xTwitterAccounts,
            'X (Twitter) account',
            static function (array $row): Recipient {
                return new Recipient([
                    'name'                      => $row['label'] ?? null,
                    'xTwitterLabel'             => $row['label'] ?? null,
                    'xTwitterConsumerKey'       => $row['consumerKey'] ?? null,
                    'xTwitterConsumerKeySecret' => $row['consumerKeySecret'] ?? null,
                    'xTwitterAccessToken'       => $row['accessToken'] ?? null,
                    'xTwitterAccessTokenSecret' => $row['accessTokenSecret'] ?? null,
                ]);
            }
        );
    }

    /**
     * Get Bluesky account recipients by resolving selected UIDs against the named-list in plugin settings.
     *
     * @param Notification $notification
     * @return Recipient[]
     */
    private function _blueskyAccounts(Notification $notification): array
    {
        return $this->_resolveByUid(
            $notification,
            'blueskyAccountUids',
            NotifierPlugin::$plugin->getSettings()->blueskyAccounts,
            'Bluesky account',
            static function (array $row): Recipient {
                return new Recipient([
                    'name'               => $row['label'] ?? $row['handle'] ?? null,
                    'blueskyHandle'      => $row['handle'] ?? null,
                    'blueskyAppPassword' => $row['appPassword'] ?? null,
                ]);
            }
        );
    }

    /**
     * Get Mastodon account recipients by resolving selected UIDs against the named-list in plugin settings.
     *
     * @param Notification $notification
     * @return Recipient[]
     */
    private function _mastodonAccounts(Notification $notification): array
    {
        return $this->_resolveByUid(
            $notification,
            'mastodonAccountUids',
            NotifierPlugin::$plugin->getSettings()->mastodonAccounts,
            'Mastodon account',
            static function (array $row): Recipient {
                return new Recipient([
                    'name'                => $row['label'] ?? null,
                    'mastodonInstanceUrl' => $row['instanceUrl'] ?? null,
                    'mastodonAccessToken' => $row['accessToken'] ?? null,
                ]);
            }
        );
    }

    /**
     * Get LinkedIn account recipients by resolving selected UIDs against the connections table.
     *
     * Unlike the other social channels, LinkedIn connections live in a database
     * table (not plugin settings), so this resolves UIDs through the service.
     *
     * @param Notification $notification
     * @return Recipient[]
     */
    private function _linkedinAccounts(Notification $notification): array
    {
        // Pull the UIDs the notification has selected
        $uids = ($notification->recipientsConfig['linkedinAccountUids'] ?? null);

        // If no UIDs, return empty array
        if (!$uids) {
            return [];
        }

        // Normalize to array
        if (!is_array($uids)) {
            $uids = [$uids];
        }

        // Initialize the recipients
        $recipients = [];

        // Loop through each requested UID
        foreach ($uids as $uid) {

            // Get the connection from the service
            $connection = NotifierPlugin::getInstance()->linkedinConnections->getConnection($uid);

            // If the connection no longer exists (admin disconnected it), log and skip
            if (!$connection) {
                // Mint an envelope for the gone destination (named by uid) so the skip nests under it
                $envelopeId = $notification->log->envelope(
                    ['messageType' => $this->_messageTypeLabel($notification), 'recipient' => $uid],
                    []
                );

                // Log the skip under the envelope
                $notification->log->warning(Craft::t('notifier',
                    '[SKIPPED] The configured LinkedIn connection no longer exists (uid: {uid}).',
                    ['uid' => $uid]
                ), $envelopeId);
                continue;
            }

            // Build a Recipient carrying the connection UID and author URN
            $recipients[] = new Recipient([
                'name'              => ($connection['label'] ?? null),
                'linkedinUid'       => ($connection['uid'] ?? null),
                'linkedinAuthorUrn' => ($connection['authorUrn'] ?? null),
                'linkedinLabel'     => ($connection['label'] ?? null),
            ]);

        }

        // Return the recipients
        return $recipients;
    }

    /**
     * Get MQTT topic recipients by resolving selected UIDs against the named-list in plugin settings.
     *
     * @param Notification $notification
     * @return Recipient[]
     */
    private function _mqttTopics(Notification $notification): array
    {
        return $this->_resolveByUid(
            $notification,
            'mqttTopicUids',
            NotifierPlugin::$plugin->getSettings()->mqttTopics,
            'MQTT topic',
            static function (array $row): Recipient {
                return new Recipient([
                    'name'  => $row['label'] ?? null,
                    'topic' => $row['topic'] ?? null,
                ]);
            }
        );
    }

    /**
     * Resolve a list of credential UIDs from `recipientsConfig` against a named list of rows from plugin settings.
     *
     * @param Notification $notification
     * @param string $configKey The key inside `recipientsConfig` (e.g. 'slackChannelUids')
     * @param array $list The named-list array of rows from plugin settings
     * @param string $kind Human-readable label for log messages (e.g. 'Slack channel')
     * @param callable $rowToRecipient Maps a single row into a Recipient instance
     * @return Recipient[]
     */
    private function _resolveByUid(Notification $notification, string $configKey, array $list, string $kind, callable $rowToRecipient): array
    {
        // Pull the UIDs the notification has selected
        $uids = ($notification->recipientsConfig[$configKey] ?? null);

        // If no UIDs, return empty array
        if (!$uids) {
            return [];
        }

        // Normalize to array
        if (!is_array($uids)) {
            $uids = [$uids];
        }

        // Index the named list by UID for O(1) lookup
        $byUid = ArrayHelper::index($list, 'uid');

        // Initialize the recipients
        $recipients = [];

        // Loop through each requested UID
        foreach ($uids as $uid) {

            // If the UID is no longer in the list (admin removed it), log and skip
            if (!isset($byUid[$uid])) {
                // Mint an envelope for the gone destination (named by uid) so the skip nests under it
                $envelopeId = $notification->log->envelope(
                    ['messageType' => $this->_messageTypeLabel($notification), 'recipient' => $uid],
                    []
                );

                // Log the skip under the envelope
                $notification->log->warning(Craft::t('notifier',
                    '[SKIPPED] The configured {kind} no longer exists in the plugin settings (uid: {uid}).',
                    ['kind' => $kind, 'uid' => $uid]
                ), $envelopeId);
                continue;
            }

            // Build a Recipient from the row
            $recipients[] = $rowToRecipient($byUid[$uid]);

        }

        // Return the recipients
        return $recipients;
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

    /**
     * Get the outbound-envelope phrase for a notification's message type.
     *
     * @param Notification $notification
     * @return string
     */
    private function _messageTypeLabel(Notification $notification): string
    {
        // Map each message type to its outbound-envelope phrase
        $labels = [
            'email'        => 'an email',
            'announcement' => 'an announcement',
            'flash'        => 'a flash message',
            'sms'          => 'an SMS message',
            'pushover'     => 'a Pushover message',
            'ntfy'         => 'an ntfy message',
            'slack'        => 'a Slack message',
            'discord'      => 'a Discord message',
            'facebook'     => 'a Facebook post',
            'instagram'    => 'an Instagram post',
            'x-twitter'    => 'an X (Twitter) post',
            'bluesky'      => 'a Bluesky post',
            'mastodon'     => 'a Mastodon post',
            'linkedin'     => 'a LinkedIn post',
            'mqtt'         => 'an MQTT message',
        ];

        // Return the matching phrase, or a generic fallback
        return ($labels[$notification->messageType] ?? 'a message');
    }

}
