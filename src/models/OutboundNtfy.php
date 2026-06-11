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
use doublesecretagency\notifier\NotifierPlugin;
use GuzzleHttp\Exception\GuzzleException;
use Throwable;

/**
 * Envelope for an outbound ntfy push notification.
 *
 * @since 3.0.0
 */
class OutboundNtfy extends BaseEnvelope
{

    /**
     * @var string|null ntfy topic name.
     */
    public ?string $topic = null;

    /**
     * @var string Rendered Twig title.
     */
    public string $title = '';

    /**
     * @var string Rendered Twig body.
     */
    public string $body = '';

    /**
     * @var int Priority (1-5, default 3).
     */
    public int $priority = 3;

    /**
     * @var string|null Optional comma-separated tag list (emoji shortcodes).
     */
    public ?string $tags = null;

    /**
     * @var string|null Optional click URL (rendered Twig).
     */
    public ?string $clickUrl = null;

    /**
     * @var bool Whether the body should be parsed as markdown by the ntfy client.
     */
    public bool $markdown = false;

    /**
     * Send the ntfy push notification.
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

        // Resolve the server URL, falling back to the public ntfy.sh server
        $serverUrl = App::parseEnv($settings->ntfyServerUrl) ?: 'https://ntfy.sh';

        // If recipient has no topic, log error and bail
        if (!$this->topic) {
            $notification->log->error(Craft::t('notifier', 'Unable to send ntfy message, no topic specified.'), $this->envelopeId);
            return false;
        }

        // Normalize endpoint
        $endpoint = rtrim($serverUrl, '/').'/'.$this->topic;

        // Build headers
        $headers = ['Content-Type' => 'text/plain; charset=utf-8'];

        // Add optional access token
        $accessToken = App::parseEnv($settings->ntfyAccessToken);
        if ($accessToken) {
            $headers['Authorization'] = "Bearer {$accessToken}";
        }

        // Add optional Title header (ntfy expects raw ASCII; encode if present)
        if ($this->title !== '') {
            $headers['Title'] = $this->_encodeHeaderValue($this->title);
        }

        // Add Priority header (clamp to 1-5)
        $headers['Priority'] = (string) max(1, min(5, $this->priority));

        // Add optional Tags header
        if ($this->tags) {
            $headers['Tags'] = $this->tags;
        }

        // Add optional Click URL header
        if ($this->clickUrl) {
            $headers['Click'] = $this->clickUrl;
        }

        // Add Markdown header if requested
        if ($this->markdown) {
            $headers['Markdown'] = 'yes';
        }

        // Attempt to send via Guzzle
        try {

            // Get the Guzzle client
            $client = Craft::createGuzzleClient();

            // POST to the topic
            $response = $client->post($endpoint, [
                'headers'     => $headers,
                'body'        => $this->body,
                'http_errors' => false,
                'timeout'     => 15,
            ]);

            // Inspect status code
            $status = $response->getStatusCode();

            // ntfy returns 200 on success
            if ($status < 200 || $status >= 300) {
                $reason = (string) $response->getBody();
                $notification->log->error(Craft::t('notifier', 'ntfy POST failed with HTTP {status}: {reason}', ['status' => $status, 'reason' => $reason]), $this->envelopeId);
                return false;
            }

        } catch (GuzzleException|Throwable $exception) {

            // Set error message
            $message = ($exception->getMessage() ?: 'Unknown error: '.Json::encode($exception));

            // Log error message
            $notification->log->error(Craft::t('notifier', 'ntfy POST failed: {reason}', ['reason' => $message]), $this->envelopeId);

            // Return failure
            return false;
        }

        // Log success
        $notification->log->success(Craft::t('notifier', 'Successfully sent ntfy message to topic "{topic}".', ['topic' => $this->topic]), $this->envelopeId);

        // Return success
        return true;
    }

    // ========================================================================= //

    /**
     * Encode an HTTP header value safely (ntfy headers must be RFC 2047 if non-ASCII).
     *
     * @param string $value
     * @return string
     */
    private function _encodeHeaderValue(string $value): string
    {
        // ASCII-only stays as-is for readability
        if (preg_match('//u', $value) && preg_match('/^[\x20-\x7E]*$/', $value)) {
            return $value;
        }

        // Encode as RFC 2047 quoted-printable for header safety
        return '=?UTF-8?B?'.base64_encode($value).'?=';
    }

}
