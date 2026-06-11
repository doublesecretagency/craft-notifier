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

namespace doublesecretagency\notifier\models;

use craft\base\Model;
use craft\elements\User;

/**
 * A resolved recipient of a notification.
 *
 * @since 1.0.0
 */
class Recipient extends Model
{

    /**
     * @var User|null The Craft user this recipient maps to, if any.
     */
    public ?User $user = null;

    /**
     * @var string|null Handle of the User field holding the email address.
     */
    public ?string $emailField = null;

    /**
     * @var string|null Handle of the User field holding the phone number.
     */
    public ?string $smsField = null;

    /**
     * @var string|null Display name.
     */
    public ?string $name = null;

    /**
     * @var string|null Recipient email address.
     */
    public ?string $emailAddress = null;

    /**
     * @var string|null Recipient phone number.
     */
    public ?string $phoneNumber = null;

    /**
     * @var string|null ntfy topic name (for the ntfy message type).
     */
    public ?string $topic = null;

    /**
     * @var string|null Slack bot token (xoxb-...). May be a $ENV_VAR reference, resolved at send time.
     */
    public ?string $slackBotToken = null;

    /**
     * @var string|null Slack channel ID (e.g. "C01234ABCD"). May be a $ENV_VAR reference, resolved at send time.
     */
    public ?string $slackChannelId = null;

    /**
     * @var string|null Slack channel label (e.g. "#engineering").
     */
    public ?string $slackChannelLabel = null;

    /**
     * @var string|null Discord webhook URL. May be a $ENV_VAR reference, resolved at send time.
     */
    public ?string $discordWebhookUrl = null;

    /**
     * @var string|null Discord channel label (e.g. "#general").
     */
    public ?string $discordChannelLabel = null;

    /**
     * @var string|null Bluesky handle (e.g. "example.bsky.social").
     */
    public ?string $blueskyHandle = null;

    /**
     * @var string|null Bluesky app password. May be a $ENV_VAR reference, resolved at send time.
     */
    public ?string $blueskyAppPassword = null;

    /**
     * @var string|null Mastodon instance base URL (e.g. "https://mastodon.social").
     */
    public ?string $mastodonInstanceUrl = null;

    /**
     * @var string|null Mastodon access token. May be a $ENV_VAR reference, resolved at send time.
     */
    public ?string $mastodonAccessToken = null;

    /**
     * Populate missing data from the attached User or raw contact info.
     *
     * @return void
     */
    public function init(): void
    {
        parent::init();

        // Extract relevant data from User (when a User is attached)
        $this->_extractUserData();

        // Derive name from raw contact info (when no User is attached)
        $this->_deriveNameFromContact();
    }

    /**
     * Extract all relevant data from the User.
     *
     * @return void
     */
    private function _extractUserData(): void
    {
        // If no user was specified, bail
        if (!$this->user) {
            return;
        }

        // If no preset name
        if (!$this->name) {
            // Get from the user
            $this->name = $this->user->getName();
        }

        // If no preset email address
        if (!$this->emailAddress) {
            // If an alternate email field was specified
            if ($this->emailField) {
                // Get from alternate email address
                $this->emailAddress = $this->user->{$this->emailField};
            } else {
                // Get from default User email address
                $this->emailAddress = $this->user->email;
            }
        }

        // If no preset phone number and field exists
        if (!$this->phoneNumber && $this->smsField) {
            // Get from User's custom phone number
            $this->phoneNumber = $this->user->{$this->smsField};
        }
    }

    /**
     * Derive a display name from raw contact info when no User is attached.
     *
     * Keeps log rows for Dynamic Recipients legible by falling back to the first available
     * contact identifier instead of the generic "dynamic recipients" task label.
     *
     * @return void
     */
    private function _deriveNameFromContact(): void
    {
        // If a name is already set, bail
        if ($this->name) {
            return;
        }

        // Fall back to the first available contact identifier
        $this->name = (
            $this->emailAddress
            ?? $this->phoneNumber
            ?? $this->topic
            ?? $this->slackChannelLabel
            ?? $this->discordChannelLabel
            ?? $this->blueskyHandle
            ?? $this->mastodonInstanceUrl
        );
    }

    // ========================================================================= //

    /**
     * Get recipient's name or email address.
     *
     * @return string
     */
    public function __toString(): string
    {
        // Return recipient's name or email address
        return ($this->name ?? $this->emailAddress ?? '');
    }

}
