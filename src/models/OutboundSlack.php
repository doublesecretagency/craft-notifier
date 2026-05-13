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
     * @var string|null Slack Incoming Webhook URL. May be a $ENV_VAR reference, resolved at send time.
     */
    public ?string $webhookUrl = null;

    /**
     * @var string|null Friendly name for the webhook (e.g. "#engineering").
     */
    public ?string $label = null;

    /**
     * @var string Rendered Twig body (Slack mrkdwn).
     */
    public string $body = '';

    /**
     * Send the Slack message via Incoming Webhook.
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

        // Resolve the webhook URL (supports a $ENV_VAR reference)
        $webhookUrl = App::parseEnv($this->webhookUrl);

        // If webhook URL is missing, log error and bail
        if (!$webhookUrl) {
            $notification->log->error(Craft::t('notifier', 'Unable to send Slack message, no webhook URL.'), $this->envelopeId);
            return false;
        }

        // If webhook URL is not valid, log error and bail
        if (!static::isValidWebhookUrl($webhookUrl)) {
            $notification->log->error(Craft::t('notifier', 'Unable to send Slack message, webhook URL is not valid.'), $this->envelopeId);
            return false;
        }

        // If body is empty, log error and bail
        if ('' === trim($this->body)) {
            $notification->log->error(Craft::t('notifier', 'Unable to send Slack message, body is empty.'), $this->envelopeId);
            return false;
        }

        // Resolve a display label for log lines
        $displayLabel = ($this->label ?: 'webhook');

        // Attempt to send via Guzzle
        try {

            // Get the Guzzle client
            $client = Craft::createGuzzleClient();

            // POST to the webhook URL
            $response = $client->post($webhookUrl, [
                'headers'     => ['Content-Type' => 'application/json'],
                'json'        => [
                    'text'   => $this->body,
                    'mrkdwn' => true,
                ],
                'http_errors' => false,
                'timeout'     => 15,
            ]);

            // Inspect response
            $status = $response->getStatusCode();
            $rawBody = trim((string) $response->getBody());

            // Slack returns 200 with body "ok" on success
            if (200 !== $status || 'ok' !== $rawBody) {
                $notification->log->error(Craft::t('notifier', 'Slack POST failed (HTTP {status}): {reason}', ['status' => $status, 'reason' => $rawBody]), $this->envelopeId);
                return false;
            }

        } catch (GuzzleException|Throwable $exception) {

            // Set error message
            $message = ($exception->getMessage() ?: 'Unknown error: '.Json::encode($exception));

            // Log error message
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
     * Validate that a webhook URL is on the canonical Slack incoming-webhook host.
     *
     * @param string|null $url
     * @return bool
     */
    public static function isValidWebhookUrl(?string $url): bool
    {
        // If no URL, mark invalid
        if (!$url) {
            return false;
        }

        // Enforce Slack's documented webhook host
        return (bool) preg_match('#^https://hooks\.slack\.com/services/#', $url);
    }

}
