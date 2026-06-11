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
 * Envelope for an outbound Mastodon post.
 *
 * @since 3.1.0
 */
class OutboundMastodon extends BaseEnvelope
{

    /**
     * @var string|null Mastodon instance base URL (e.g. "https://mastodon.social"). May be a $ENV_VAR reference, resolved at send time.
     */
    public ?string $instanceUrl = null;

    /**
     * @var string|null Mastodon access token. May be a $ENV_VAR reference, resolved at send time.
     */
    public ?string $accessToken = null;

    /**
     * @var string|null Friendly name for the account (e.g. "@team@mastodon.social").
     */
    public ?string $label = null;

    /**
     * @var string Rendered Twig body (plain text).
     */
    public string $body = '';

    /**
     * @var string Post visibility (public, unlisted, private, or direct).
     */
    public string $visibility = 'public';

    /**
     * Send the Mastodon post via the statuses API.
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

        // Resolve the instance URL
        $instanceUrl = App::parseEnv($this->instanceUrl);

        // If the instance URL is missing, log error and bail
        if (!$instanceUrl) {
            $notification->log->error(Craft::t('notifier', 'Unable to send Mastodon post, no instance URL.'), $this->envelopeId);
            return false;
        }

        // Resolve the access token
        $accessToken = App::parseEnv($this->accessToken);

        // If the access token is missing, log error and bail
        if (!$accessToken) {
            $notification->log->error(Craft::t('notifier', 'Unable to send Mastodon post, no access token.'), $this->envelopeId);
            return false;
        }

        // If body is empty, log error and bail
        if ('' === trim($this->body)) {
            $notification->log->error(Craft::t('notifier', 'Unable to send Mastodon post, body is empty.'), $this->envelopeId);
            return false;
        }

        // Resolve a display label for log lines
        $displayLabel = ($this->label ?: $instanceUrl);

        // Attempt to send via Guzzle
        try {

            // Get the Guzzle client
            $client = Craft::createGuzzleClient();

            // POST to the statuses endpoint
            $response = $client->post(rtrim($instanceUrl, '/').'/api/v1/statuses', [
                'headers'     => [
                    'Authorization' => 'Bearer '.$accessToken,
                    'Content-Type'  => 'application/json',
                ],
                'json'        => [
                    'status'     => $this->body,
                    'visibility' => $this->visibility,
                ],
                'http_errors' => false,
                'timeout'     => 15,
            ]);

            // Inspect response
            $status = $response->getStatusCode();
            $decoded = json_decode((string) $response->getBody(), true);

            // If Mastodon rejected the post
            if ($status < 200 || $status >= 300 || !is_array($decoded) || !isset($decoded['id'])) {
                // Get the error message
                $error = (is_array($decoded) ? ($decoded['error'] ?? "HTTP {$status}") : "HTTP {$status}");
                // Log the error
                $notification->log->error(Craft::t('notifier', 'Mastodon rejected the post: {error}', ['error' => $error]), $this->envelopeId);
                // Bail
                return false;
            }

        } catch (GuzzleException|Throwable $exception) {

            // Get the error message (or fall back to a JSON encoded version)
            $message = ($exception->getMessage() ?: 'Unknown error: '.Json::encode($exception));

            // Log the error message
            $notification->log->error(Craft::t('notifier', 'Mastodon POST failed: {reason}', ['reason' => $message]), $this->envelopeId);

            // Return failure
            return false;
        }

        // Log success
        $notification->log->success(Craft::t('notifier', 'Successfully sent Mastodon post to "{label}".', ['label' => $displayLabel]), $this->envelopeId);

        // Return success
        return true;
    }

}
