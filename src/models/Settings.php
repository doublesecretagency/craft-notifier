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

/**
 * Plugin settings model.
 *
 * @since 1.0.0
 */
class Settings extends Model
{

    /**
     * @var string Default Bluesky PDS URL, used when no custom PDS is configured.
     */
    public const DEFAULT_PDS_URL = 'https://bsky.social';

    /**
     * @var string New notifications are added before the others (top of the list).
     */
    public const DEFAULT_PLACEMENT_BEGINNING = 'beginning';

    /**
     * @var string New notifications are added after the others (bottom of the list).
     */
    public const DEFAULT_PLACEMENT_END = 'end';

    // ========================================================================= //

    /**
     * @var string Where new notifications are added in the manual order.
     */
    public string $defaultPlacement = self::DEFAULT_PLACEMENT_END;

    /**
     * @var string|null UID of the Structure that backs the manual notification order.
     */
    public ?string $structureUid = null;

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
     * @var array Named list of Discord channels. Each row: ['uid' => string, 'label' => string, 'webhookUrl' => string]. The webhookUrl may be a $ENV_VAR reference, resolved at send time.
     */
    public array $discordChannels = [];

    // ========================================================================= //

    /**
     * @var array Named list of Facebook pages. Each row: ['uid' => string, 'label' => string, 'pageId' => string, 'pageAccessToken' => string]. The pageAccessToken may be a $ENV_VAR reference, resolved at send time.
     */
    public array $facebookPages = [];

    // ========================================================================= //

    /**
     * @var array Named list of Instagram accounts. Each row: ['uid' => string, 'label' => string, 'pageId' => string, 'pageAccessToken' => string, 'igUserId' => string]. The igUserId is resolved and cached on save/test; the pageAccessToken may be a $ENV_VAR reference, resolved at send time.
     */
    public array $instagramAccounts = [];

    // ========================================================================= //

    /**
     * @var array Named list of X (Twitter) accounts. Each row: ['uid' => string, 'label' => string, 'consumerKey' => string, 'consumerKeySecret' => string, 'accessToken' => string, 'accessTokenSecret' => string]. Any value may be a $ENV_VAR reference, resolved at send time.
     */
    public array $xTwitterAccounts = [];

    // ========================================================================= //

    /**
     * @var string|null Bluesky PDS URL (default https://bsky.social).
     */
    public ?string $blueskyPdsUrl = self::DEFAULT_PDS_URL;

    /**
     * @var array Named list of Bluesky accounts. Each row: ['uid' => string, 'label' => string, 'handle' => string, 'appPassword' => string]. The appPassword may be a $ENV_VAR reference, resolved at send time.
     */
    public array $blueskyAccounts = [];

    // ========================================================================= //

    /**
     * @var array Named list of Mastodon accounts. Each row: ['uid' => string, 'label' => string, 'instanceUrl' => string, 'accessToken' => string]. The accessToken may be a $ENV_VAR reference, resolved at send time.
     */
    public array $mastodonAccounts = [];

    // ========================================================================= //

    /**
     * @var string|null MQTT broker hostname. May be a $ENV_VAR reference.
     */
    public ?string $mqttHost = null;

    /**
     * @var int|null MQTT broker port. Defaults to 8883 when TLS is on, otherwise 1883.
     */
    public ?int $mqttPort = null;

    /**
     * @var bool Whether to connect to the broker over TLS.
     */
    public bool $mqttUseTls = false;

    /**
     * @var string|null MQTT username. May be a $ENV_VAR reference.
     */
    public ?string $mqttUsername = null;

    /**
     * @var string|null MQTT password. May be a $ENV_VAR reference.
     */
    public ?string $mqttPassword = null;

    /**
     * @var string|null Optional client ID prefix. Auto-generated when empty.
     */
    public ?string $mqttClientId = null;

    /**
     * @var string Protocol version sent to the broker (default 3.1.1).
     */
    public string $mqttProtocolLevel = '3.1.1';

    /**
     * @var string|null Path to the CA certificate file (for TLS / Mutual TLS). May be a $ENV_VAR reference.
     */
    public ?string $mqttTlsCaFile = null;

    /**
     * @var string|null Path to the client certificate file (for Mutual TLS). May be a $ENV_VAR reference.
     */
    public ?string $mqttTlsClientCertFile = null;

    /**
     * @var string|null Path to the client private key file (for Mutual TLS). May be a $ENV_VAR reference.
     */
    public ?string $mqttTlsClientKeyFile = null;

    /**
     * @var array Named list of MQTT topics. Each row: ['uid' => string, 'label' => string, 'topic' => string].
     */
    public array $mqttTopics = [];

    // ========================================================================= //

    /**
     * @inheritdoc
     */
    public function defineRules(): array
    {
        return [
            // Default placement must be one of the two known values
            ['defaultPlacement', 'in', 'range' => [
                self::DEFAULT_PLACEMENT_BEGINNING,
                self::DEFAULT_PLACEMENT_END,
            ]],
        ];
    }

}
