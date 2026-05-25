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
use doublesecretagency\notifier\NotifierPlugin;
use GuzzleHttp\Exception\GuzzleException;
use Throwable;

/**
 * Class OutboundPushover
 * @since 3.0.0
 */
class OutboundPushover extends BaseEnvelope
{

    /**
     * @var string Pushover API endpoint.
     */
    public const ENDPOINT = 'https://api.pushover.net/1/messages.json';

    /**
     * @var string|null Recipient's Pushover user key (read from the configured Craft User field).
     */
    public ?string $userKey = null;

    /**
     * @var string Rendered Twig title.
     */
    public string $title = '';

    /**
     * @var string Rendered Twig body.
     */
    public string $body = '';

    /**
     * Send the Pushover message.
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

        /** @var Settings $settings */
        $settings = NotifierPlugin::$plugin->getSettings();

        // Resolve app token via env-var dereference
        $appToken = App::parseEnv($settings->pushoverApplicationToken);

        // If app token is missing, log error and bail
        if (!$appToken) {

            // Link to docs for Pushover setup
            $url = 'https://plugins.doublesecretagency.com/notifier/getting-started/integrations/pushover';

            // Log error
            $notification->log->error(Craft::t('notifier', '[Invalid Pushover credentials.]({url}) Missing app token.', ['url' => $url]), $this->envelopeId);

            // Return failure
            return false;
        }

        // If recipient has no user key, log error and bail
        if (!$this->userKey) {
            $notification->log->error(Craft::t('notifier', 'Unable to send Pushover message, no user key on recipient.'), $this->envelopeId);
            return false;
        }

        // Attempt to send via Guzzle
        try {

            // Get the Guzzle client
            $client = Craft::createGuzzleClient();

            // POST form-encoded to the Pushover messages endpoint
            $response = $client->post(static::ENDPOINT, [
                'form_params' => [
                    'token'   => $appToken,
                    'user'    => $this->userKey,
                    'title'   => $this->title,
                    'message' => $this->body,
                ],
                'http_errors' => false,
                'timeout'     => 15,
            ]);

            // Inspect response
            $status = $response->getStatusCode();
            $payload = Json::decodeIfJson((string) $response->getBody());

            // Pushover returns {"status": 1} on success
            $pushoverStatus = (is_array($payload) ? ($payload['status'] ?? null) : null);

            if (200 !== $status || 1 !== $pushoverStatus) {
                // Extract Pushover's error array if present
                $errors = (is_array($payload) ? ($payload['errors'] ?? []) : []);
                $reason = ($errors ? implode(', ', $errors) : "HTTP {$status}");
                $notification->log->error(Craft::t('notifier', 'Pushover POST failed: {reason}', ['reason' => $reason]), $this->envelopeId);
                return false;
            }

        } catch (GuzzleException|Throwable $exception) {

            // Set error message
            $message = ($exception->getMessage() ?: 'Unknown error: '.Json::encode($exception));

            // Log error message
            $notification->log->error(Craft::t('notifier', 'Pushover POST failed: {reason}', ['reason' => $message]), $this->envelopeId);

            // Return failure
            return false;
        }

        // Log success
        $notification->log->success(Craft::t('notifier', 'Successfully sent Pushover message!'), $this->envelopeId);

        // Return success
        return true;
    }

}
