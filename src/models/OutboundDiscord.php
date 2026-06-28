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

use Craft;
use craft\helpers\App;
use craft\helpers\Json;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\helpers\Notifier;
use GuzzleHttp\Exception\GuzzleException;
use Throwable;

/**
 * Envelope for an outbound Discord message.
 *
 * @since 3.1.0
 */
class OutboundDiscord extends BaseEnvelope
{

    /**
     * @var string|null Discord webhook URL. May be a $ENV_VAR reference, resolved at send time.
     */
    public ?string $webhookUrl = null;

    /**
     * @var string|null Friendly name for the channel (e.g. "#general").
     */
    public ?string $label = null;

    /**
     * @var string Rendered Twig body (Discord markdown).
     */
    public string $body = '';

    /**
     * @var string Rendered display name. Empty when the webhook's default name should be used.
     */
    public string $username = '';

    /**
     * @var string Rendered avatar URL. Empty when the webhook's default avatar should be used.
     */
    public string $avatarUrl = '';

    /**
     * @var bool Whether Discord should show link previews for URLs in the body.
     */
    public bool $unfurlLinks = true;

    /**
     * Send the Discord message via the channel webhook.
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

        // Resolve the webhook URL
        $webhookUrl = App::parseEnv($this->webhookUrl);

        // If the webhook URL is missing, log error and bail
        if (!$webhookUrl) {
            $notification->log->error(Craft::t('notifier', '[BAD CREDENTIALS] No Discord webhook URL is configured.'), $this->envelopeId);
            return false;
        }

        // If body is empty, log error and bail
        if ('' === trim($this->body)) {
            $notification->log->error(Craft::t('notifier', '[EMPTY BODY] The Discord message body is empty.'), $this->envelopeId);
            return false;
        }

        // If body exceeds Discord's hard limit, log error and bail
        if (mb_strlen($this->body) > 2000) {
            $notification->log->error(Craft::t('notifier', '[TOO LONG] The Discord message body exceeds the 2000-character limit.'), $this->envelopeId);
            return false;
        }

        // Resolve a display label for log lines
        $displayLabel = ($this->label ?: 'a Discord channel');

        // Attempt to send via Guzzle
        try {

            // Get the Guzzle client
            $client = Craft::createGuzzleClient();

            // Build the webhook payload
            $payload = ['content' => $this->body];

            // If a username override is set, include it
            if ('' !== $this->username) {
                $payload['username'] = $this->username;
            }

            // If an avatar URL override is set, include it
            if ('' !== $this->avatarUrl) {
                $payload['avatar_url'] = $this->avatarUrl;
            }

            // If link previews are disabled, suppress embeds
            if (!$this->unfurlLinks) {
                $payload['flags'] = 4; // (1 << 2)
            }

            // POST to the webhook
            $response = $client->post($webhookUrl.'?wait=true', [
                'json'        => $payload,
                'http_errors' => false,
                'timeout'     => 15,
            ]);

            // Inspect response
            $status = $response->getStatusCode();

            // If Discord rejected the message
            if ($status < 200 || $status >= 300) {
                // Decode the response body
                $decoded = json_decode((string) $response->getBody(), true);
                // Get the error message
                $error = (is_array($decoded) ? ($decoded['message'] ?? "HTTP {$status}") : "HTTP {$status}");
                // Log the error
                $notification->log->error(Craft::t('notifier', '[REJECTED BY DISCORD] {error}', ['error' => $error]), $this->envelopeId);
                // Bail
                return false;
            }

        } catch (GuzzleException|Throwable $exception) {

            // Get the error message (or fall back to a JSON encoded version)
            $message = ($exception->getMessage() ?: 'Unknown error: '.Json::encode($exception));

            // Log the error message
            $notification->log->error(Craft::t('notifier', '[SEND FAILED] {reason}', ['reason' => $message]), $this->envelopeId);

            // Return failure
            return false;
        }

        // Log success
        $notification->log->success(Craft::t('notifier', 'Successfully posted to Discord in channel "{label}".', ['label' => $displayLabel]), $this->envelopeId);

        // Return success
        return true;
    }

    // ========================================================================= //

    /**
     * Validate that a value looks like a Discord webhook URL.
     *
     * @param string|null $webhookUrl
     * @return bool
     */
    public static function isValidWebhookUrl(?string $webhookUrl): bool
    {
        // If no webhook URL, mark invalid
        if (!$webhookUrl) {
            return false;
        }

        // Enforce Discord's documented webhook URL shape
        return (bool) preg_match('#^https://(canary\.|ptb\.)?discord(app)?\.com/api/webhooks/\d+/[\w-]+$#', $webhookUrl);
    }

}
