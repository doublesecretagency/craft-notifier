<?php
/**
 * Notifier plugin for Craft CMS
 *
 * First-class Notifications for Craft CMS
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

namespace doublesecretagency\notifier\models;

use craft\base\Model;

/**
 * Class Settings
 * @since 1.0.0
 */
class Settings extends Model
{

    /**
     * @var string Default Bluesky PDS URL, used when no custom PDS is configured.
     */
    public const DEFAULT_PDS_URL = 'https://bsky.social';

    // ========================================================================= //

    /**
     * @var bool Whether the plugin should write to the notifier_log table.
     */
    public bool $loggingEnabled = true;

    /**
     * @var int|null Maximum age (in days) of log entries to retain. Null means no maximum.
     */
    public ?int $logRetentionDays = null;

    /**
     * @var int|null Maximum number of dispatches to retain. Null means no maximum.
     */
    public ?int $logRetentionRecords = null;

    // ========================================================================= //

    /**
     * @var string|null Shared secret for the scheduled-run web endpoint. May be a `$ENV_VAR` reference.
     */
    public ?string $scheduledToken = null;

    // ========================================================================= //

    /**
     * @var string|null Twilio Account SID.
     */
    public ?string $twilioAccountSid = null;

    /**
     * @var string|null Twilio Auth Token.
     */
    public ?string $twilioAuthToken = null;

    /**
     * @var string|null Twilio phone number (sends each SMS message).
     */
    public ?string $twilioPhoneNumber = null; // FROM

    /**
     * @var string|null Recipient phone number for testing purposes.
     */
    public ?string $testToPhoneNumber = null; // TO

    // ========================================================================= //

    /**
     * @var string|null Pushover application token.
     */
    public ?string $pushoverApplicationToken = null;

    // ========================================================================= //

    /**
     * @var string|null ntfy server URL. When unset, Notifier falls back to https://ntfy.sh at send time.
     */
    public ?string $ntfyServerUrl = null;

    /**
     * @var string|null ntfy access token (optional, for protected topics).
     */
    public ?string $ntfyAccessToken = null;

    /**
     * @var array Named list of ntfy topics. Each row: ['uid' => string, 'label' => string, 'topic' => string].
     */
    public array $ntfyTopics = [];

    // ========================================================================= //

    /**
     * @var array Named list of Slack channels. Each row: ['uid' => string, 'label' => string, 'botToken' => string, 'channelId' => string]. The botToken may be a $ENV_VAR reference, resolved at send time.
     */
    public array $slackChannels = [];

    // ========================================================================= //

    /**
     * @var string|null Bluesky PDS URL (default https://bsky.social).
     */
    public ?string $blueskyPdsUrl = self::DEFAULT_PDS_URL;

    /**
     * @var array Named list of Bluesky accounts. Each row: ['uid' => string, 'label' => string, 'handle' => string, 'appPassword' => string]. The appPassword may be a $ENV_VAR reference, resolved at send time.
     */
    public array $blueskyAccounts = [];

}
