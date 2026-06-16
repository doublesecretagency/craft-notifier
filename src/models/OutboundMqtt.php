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
use PhpMqtt\Client\ConnectionSettings;
use PhpMqtt\Client\MqttClient;
use Throwable;

/**
 * Envelope for an outbound MQTT publish.
 *
 * @since 3.1.0
 */
class OutboundMqtt extends BaseEnvelope
{

    /**
     * @var string|null MQTT topic to publish to.
     */
    public ?string $topic = null;

    /**
     * @var string Rendered Twig payload.
     */
    public string $payload = '';

    /**
     * @var int Quality of service (0, 1, or 2).
     */
    public int $qos = 0;

    /**
     * @var bool Whether the broker should retain this as the last message on the topic.
     */
    public bool $retain = false;

    /**
     * Publish the MQTT message to the broker.
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

        // Get the broker host
        $host = App::parseEnv($settings->mqttHost);

        // If no broker host is configured, log error and bail
        if (!$host) {
            $notification->log->error(Craft::t('notifier', '[BAD CREDENTIALS] No MQTT broker host is configured.'), $this->envelopeId);
            return false;
        }

        // If recipient has no topic, log error and bail
        if (!$this->topic) {
            $notification->log->error(Craft::t('notifier', '[NO RECIPIENT] No MQTT topic was specified.'), $this->envelopeId);
            return false;
        }

        // If the payload is empty, log error and bail
        if ('' === trim($this->payload)) {
            $notification->log->error(Craft::t('notifier', '[EMPTY BODY] The MQTT payload is empty.'), $this->envelopeId);
            return false;
        }

        // Whether to connect over TLS
        $useTls = (bool) $settings->mqttUseTls;

        // Get the port, defaulting to 8883 for TLS or 1883 for plain
        $port = ($settings->mqttPort ?: ($useTls ? 8883 : 1883));

        // Get the client ID, generating a unique one when empty
        $clientId = (App::parseEnv($settings->mqttClientId) ?: 'notifier-'.uniqid());

        // Get the protocol level, defaulting to 3.1.1
        $protocol = ($settings->mqttProtocolLevel ?: MqttClient::MQTT_3_1_1);

        // Attempt to publish via the broker
        try {

            // Build the MQTT client
            $client = new MqttClient($host, (int) $port, $clientId, $protocol);

            // Build the connection settings
            $connectionSettings = (new ConnectionSettings())
                ->setUsername(App::parseEnv($settings->mqttUsername) ?: null)
                ->setPassword(App::parseEnv($settings->mqttPassword) ?: null)
                ->setKeepAliveInterval(60)
                ->setConnectTimeout(15)
                ->setUseTls($useTls);

            // If using TLS with a CA certificate, configure it
            if ($useTls && ($caFile = App::parseEnv($settings->mqttTlsCaFile))) {
                $connectionSettings->setTlsCertificateAuthorityFile($caFile);
            }

            // If using Mutual TLS, configure the client certificate and key
            if ($useTls && ($clientCert = App::parseEnv($settings->mqttTlsClientCertFile))) {
                $connectionSettings->setTlsClientCertificateFile($clientCert);
            }
            if ($useTls && ($clientKey = App::parseEnv($settings->mqttTlsClientKeyFile))) {
                $connectionSettings->setTlsClientCertificateKeyFile($clientKey);
            }

            // Connect with a clean session
            $client->connect($connectionSettings, true);

            // Publish the message
            $client->publish($this->topic, $this->payload, $this->qos, $this->retain);

            // For QoS 1/2, process the broker acknowledgement before disconnecting
            if ($this->qos > 0) {
                $client->loop(true, true);
            }

            // Disconnect cleanly
            $client->disconnect();

        } catch (Throwable $exception) {

            // Set error message
            $message = ($exception->getMessage() ?: 'Unknown error: '.Json::encode($exception));

            // Log error message
            $notification->log->error(Craft::t('notifier', '[SEND FAILED] {reason}', ['reason' => $message]), $this->envelopeId);

            // Return failure
            return false;
        }

        // Log success
        $notification->log->success(Craft::t('notifier', 'Successfully sent MQTT message to topic "{topic}".', ['topic' => $this->topic]), $this->envelopeId);

        // Return success
        return true;
    }

    // ========================================================================= //

    /**
     * Whether a string is a valid MQTT publish topic.
     *
     * @param string|null $topic
     * @return bool
     */
    public static function isValidTopic(?string $topic): bool
    {
        // Coerce to string
        $topic = (string) $topic;

        // If empty, invalid
        if ('' === trim($topic)) {
            return false;
        }

        // If it contains a subscribe-only wildcard, invalid for publishing
        if (str_contains($topic, '+') || str_contains($topic, '#')) {
            return false;
        }

        // If it contains a null byte, invalid
        if (str_contains($topic, "\0")) {
            return false;
        }

        // Otherwise valid
        return true;
    }

}
