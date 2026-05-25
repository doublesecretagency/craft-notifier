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

use Craft;
use craft\helpers\App;
use craft\helpers\Json;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\helpers\Notifier;
use GuzzleHttp\Exception\GuzzleException;
use Throwable;

/**
 * Class OutboundSlack
 * @since 3.0.0
 */
class OutboundSlack extends BaseEnvelope
{

    /**
     * @var string|null Slack bot token (xoxb-...). May be a $ENV_VAR reference, resolved at send time.
     */
    public ?string $botToken = null;

    /**
     * @var string|null Slack channel ID (e.g. "C01234ABCD").
     */
    public ?string $channelId = null;

    /**
     * @var string|null Friendly name for the channel (e.g. "#engineering").
     */
    public ?string $label = null;

    /**
     * @var string Rendered Twig body (Slack mrkdwn).
     */
    public string $body = '';

    /**
     * @var string Rendered icon URL. Empty when the channel default should be used.
     */
    public string $iconUrl = '';

    /**
     * @var string Rendered icon emoji shortcode (e.g. ":rocket:"). Used only when iconUrl is empty.
     */
    public string $iconEmoji = '';

    /**
     * @var string Rendered display name. Empty when the app's default name should be used.
     */
    public string $username = '';

    /**
     * @var bool Whether Slack should unfurl link previews for URLs in the body.
     */
    public bool $unfurlLinks = true;

    /**
     * Send the Slack message via the chat.postMessage Web API.
     *
     * @return bool
     */
    public function send(): bool
    {
        // Get original notification
        /** @var Notification $notification */
        $notification = Notifier::getNotification($this->notificationId);

        // If invalid notification, bail
        if (!$notification) {
            return false;
        }

        // Resolve the bot token (supports a $ENV_VAR reference)
        $botToken = App::parseEnv($this->botToken);

        // If the bot token is missing, log error and bail
        if (!$botToken) {
            $notification->log->error(Craft::t('notifier', 'Unable to send Slack message, no bot token.'), $this->envelopeId);
            return false;
        }

        // Resolve the channel ID (supports a $ENV_VAR reference)
        $channelId = App::parseEnv($this->channelId);

        // If the channel ID is missing, log error and bail
        if (!$channelId) {
            $notification->log->error(Craft::t('notifier', 'Unable to send Slack message, no channel ID.'), $this->envelopeId);
            return false;
        }

        // If body is empty, log error and bail
        if ('' === trim($this->body)) {
            $notification->log->error(Craft::t('notifier', 'Unable to send Slack message, body is empty.'), $this->envelopeId);
            return false;
        }

        // Resolve a display label for log lines
        $displayLabel = ($this->label ?: $channelId);

        // Attempt to send via Guzzle
        try {

            // Get the Guzzle client
            $client = Craft::createGuzzleClient();

            // Build the chat.postMessage payload
            $payload = [
                'channel' => $channelId,
                'text'    => $this->body,
                'mrkdwn'  => true,
            ];

            // If an icon URL is set, include it (takes precedence over icon_emoji)
            if ('' !== $this->iconUrl) {
                $payload['icon_url'] = $this->iconUrl;
            }

            // If an icon emoji is set, include it (used only when icon_url is absent)
            if ('' !== $this->iconEmoji) {
                $payload['icon_emoji'] = $this->iconEmoji;
            }

            // If a username override is set, include it
            if ('' !== $this->username) {
                $payload['username'] = $this->username;
            }

            // If link previews are disabled, suppress them on the Slack side
            if (!$this->unfurlLinks) {
                $payload['unfurl_links'] = false;
                $payload['unfurl_media'] = false;
            }

            // POST to chat.postMessage
            $response = $client->post('https://slack.com/api/chat.postMessage', [
                'headers'     => [
                    'Authorization' => 'Bearer ' . $botToken,
                    'Content-Type'  => 'application/json; charset=utf-8',
                ],
                'json'        => $payload,
                'http_errors' => false,
                'timeout'     => 15,
            ]);

            // Inspect response
            $status = $response->getStatusCode();
            $rawBody = (string) $response->getBody();
            $decoded = json_decode($rawBody, true);

            // If Slack rejected the message, log the error code and bail
            if (!is_array($decoded) || true !== ($decoded['ok'] ?? false)) {
                $error = (is_array($decoded) ? ($decoded['error'] ?? 'unknown') : "HTTP {$status}");
                $notification->log->error(Craft::t('notifier', 'Slack rejected the message: {error}', ['error' => $error]), $this->envelopeId);
                return false;
            }

        } catch (GuzzleException|Throwable $exception) {

            // Get the error message (or fall back to a JSON encoded version)
            $message = ($exception->getMessage() ?: 'Unknown error: '.Json::encode($exception));

            // Log the error message
            $notification->log->error(Craft::t('notifier', 'Slack POST failed: {reason}', ['reason' => $message]), $this->envelopeId);

            // Return failure
            return false;
        }

        // Log success
        $notification->log->success(Craft::t('notifier', 'Successfully sent Slack message to "{label}".', ['label' => $displayLabel]), $this->envelopeId);

        // Return success
        return true;
    }

    // ========================================================================= //

    /**
     * Validate that a value looks like a Slack bot token (xoxb-...).
     *
     * @param string|null $token
     * @return bool
     */
    public static function isValidBotToken(?string $token): bool
    {
        // If no token, mark invalid
        if (!$token) {
            return false;
        }

        // Enforce Slack's documented bot token prefix
        return str_starts_with($token, 'xoxb-');
    }

    /**
     * Validate that a value looks like a Slack channel/DM/group ID.
     *
     * @param string|null $channelId
     * @return bool
     */
    public static function isValidChannelId(?string $channelId): bool
    {
        // If no channel ID, mark invalid
        if (!$channelId) {
            return false;
        }

        // Slack channel IDs start with C (channel), D (DM), or G (private group)
        return (bool) preg_match('/^[CDG][A-Z0-9]+$/', $channelId);
    }

}
