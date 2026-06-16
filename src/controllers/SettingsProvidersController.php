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

namespace doublesecretagency\notifier\controllers;

use Craft;
use craft\helpers\App;
use craft\helpers\StringHelper;
use craft\web\Controller;
use doublesecretagency\notifier\helpers\BlueskySession;
use doublesecretagency\notifier\helpers\MetaGraph;
use doublesecretagency\notifier\helpers\OAuth1Signer;
use doublesecretagency\notifier\models\OutboundDiscord;
use doublesecretagency\notifier\models\OutboundMqtt;
use doublesecretagency\notifier\models\OutboundSlack;
use doublesecretagency\notifier\models\Settings;
use doublesecretagency\notifier\NotifierPlugin;
use PhpMqtt\Client\ConnectionSettings;
use PhpMqtt\Client\MqttClient;
use Throwable;
use yii\web\BadRequestHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\Response;

/**
 * Controller for the Notifier provider settings pages.
 *
 * @since 3.0.0
 */
class SettingsProvidersController extends Controller
{

    /**
     * @inheritdoc
     */
    public array|bool|int $allowAnonymous = false;

    /**
     * Require admin access for every action in this controller.
     *
     * @inheritdoc
     */
    public function beforeAction($action): bool
    {
        // Bail if parent rejects
        if (!parent::beforeAction($action)) {
            return false;
        }

        // Only admins can manage plugin settings
        $this->requireAdmin();

        return true;
    }

    // ========================================================================= //
    // Render actions
    // ========================================================================= //

    /**
     * Render the General sub-page.
     *
     * @return Response
     */
    public function actionGeneral(): Response
    {
        return $this->_renderSubPage('general', 'General');
    }

    /**
     * Render the Twilio sub-page.
     *
     * @return Response
     */
    public function actionTwilio(): Response
    {
        return $this->_renderSubPage('twilio', 'Twilio');
    }

    /**
     * Render the Pushover sub-page.
     *
     * @return Response
     */
    public function actionPushover(): Response
    {
        return $this->_renderSubPage('pushover', 'Pushover');
    }

    /**
     * Render the ntfy sub-page.
     *
     * @return Response
     */
    public function actionNtfy(): Response
    {
        return $this->_renderSubPage('ntfy', 'ntfy');
    }

    /**
     * Render the Slack sub-page.
     *
     * @return Response
     */
    public function actionSlack(): Response
    {
        return $this->_renderSubPage('slack', 'Slack');
    }

    /**
     * Render the Discord sub-page.
     *
     * @return Response
     */
    public function actionDiscord(): Response
    {
        return $this->_renderSubPage('discord', 'Discord');
    }

    /**
     * Render the Facebook sub-page.
     *
     * @return Response
     */
    public function actionFacebook(): Response
    {
        return $this->_renderSubPage('facebook', 'Facebook');
    }

    /**
     * Render the Instagram sub-page.
     *
     * @return Response
     */
    public function actionInstagram(): Response
    {
        return $this->_renderSubPage('instagram', 'Instagram');
    }

    /**
     * Render the X (Twitter) sub-page.
     *
     * @return Response
     */
    public function actionXTwitter(): Response
    {
        return $this->_renderSubPage('x-twitter', 'X (Twitter)');
    }

    /**
     * Render the Bluesky sub-page.
     *
     * @return Response
     */
    public function actionBluesky(): Response
    {
        return $this->_renderSubPage('bluesky', 'Bluesky');
    }

    /**
     * Render the Mastodon sub-page.
     *
     * @return Response
     */
    public function actionMastodon(): Response
    {
        return $this->_renderSubPage('mastodon', 'Mastodon');
    }

    /**
     * Render the MQTT sub-page.
     *
     * @return Response
     */
    public function actionMqtt(): Response
    {
        return $this->_renderSubPage('mqtt', 'MQTT');
    }

    // ========================================================================= //
    // Save actions
    // ========================================================================= //

    /**
     * Save settings for a section.
     *
     * @return Response|null
     * @throws BadRequestHttpException
     * @throws ForbiddenHttpException
     */
    public function actionSave(): ?Response
    {
        $this->requirePostRequest();

        // Get the section being saved
        $section = $this->request->getRequiredBodyParam('section');

        // Only allow known sections
        $whitelist = ['general', 'twilio', 'pushover', 'ntfy', 'slack', 'discord', 'facebook', 'instagram', 'x-twitter', 'bluesky', 'mastodon', 'mqtt'];
        if (!in_array($section, $whitelist, true)) {
            throw new BadRequestHttpException(Craft::t('notifier', 'Invalid settings section: {section}', ['section' => $section]));
        }

        // Get the submitted settings for the section
        $posted = $this->request->getBodyParam('settings', []);

        // For sections with named lists, ensure each row has a stable UID
        if ('ntfy' === $section && isset($posted['ntfyTopics'])) {
            $posted['ntfyTopics'] = $this->_assignUids($posted['ntfyTopics']);
        }
        if ('slack' === $section && isset($posted['slackChannels'])) {
            $posted['slackChannels'] = $this->_assignUids($posted['slackChannels']);
        }
        if ('discord' === $section && isset($posted['discordChannels'])) {
            $posted['discordChannels'] = $this->_assignUids($posted['discordChannels']);
        }
        if ('facebook' === $section && isset($posted['facebookPages'])) {
            $posted['facebookPages'] = $this->_assignUids($posted['facebookPages']);
        }
        if ('instagram' === $section && isset($posted['instagramAccounts'])) {
            $posted['instagramAccounts'] = $this->_resolveInstagramIgUserIds($this->_assignUids($posted['instagramAccounts']));
        }
        if ('x-twitter' === $section && isset($posted['xTwitterAccounts'])) {
            $posted['xTwitterAccounts'] = $this->_assignUids($posted['xTwitterAccounts']);
        }
        if ('bluesky' === $section && isset($posted['blueskyAccounts'])) {
            $posted['blueskyAccounts'] = $this->_assignUids($posted['blueskyAccounts']);
        }
        if ('mastodon' === $section && isset($posted['mastodonAccounts'])) {
            $posted['mastodonAccounts'] = $this->_assignUids($posted['mastodonAccounts']);
        }
        if ('mqtt' === $section && isset($posted['mqttTopics'])) {
            $posted['mqttTopics'] = $this->_assignUids($posted['mqttTopics']);
        }

        // Get the existing settings as an array
        $plugin = NotifierPlugin::$plugin;
        /** @var Settings $current */
        $current = $plugin->getSettings();
        $existing = $current->toArray();

        // Merge posted values over the existing settings
        $merged = array_merge($existing, $posted);

        // Hand the merged settings to Craft to persist
        if (!Craft::$app->getPlugins()->savePluginSettings($plugin, $merged)) {
            Craft::$app->getSession()->setError(Craft::t('notifier', "Couldn't save settings."));
            return null;
        }

        // Flash success and redirect back to the section
        Craft::$app->getSession()->setNotice(Craft::t('notifier', 'Settings saved.'));

        return $this->redirectToPostedUrl();
    }

    // ========================================================================= //
    // Per-row Test actions
    // ========================================================================= //

    /**
     * Send a test message to a specific ntfy topic.
     *
     * @return Response
     */
    public function actionTestNtfy(): Response
    {
        $this->requirePostRequest();
        $this->requireAcceptsJson();

        // Get the posted topic
        $topic = (string) $this->request->getRequiredBodyParam('topic');

        // If the topic is empty, return an error
        if ('' === trim($topic)) {
            return $this->asJson([
                'success' => false,
                'message' => Craft::t('notifier', 'Topic is empty.'),
            ]);
        }

        // Get the plugin settings
        /** @var Settings $settings */
        $settings = NotifierPlugin::$plugin->getSettings();

        // Get the configured server URL
        $serverUrl = App::parseEnv($settings->ntfyServerUrl);

        // If no server URL is configured, return an error
        if (!$serverUrl) {
            return $this->asJson([
                'success' => false,
                'message' => Craft::t('notifier', 'Server URL is not configured.'),
            ]);
        }

        // Build the endpoint URL
        $endpoint = rtrim($serverUrl, '/').'/'.$topic;

        // Build headers
        $headers = ['Title' => 'Notifier test'];
        $token = App::parseEnv($settings->ntfyAccessToken);
        if ($token) {
            $headers['Authorization'] = "Bearer {$token}";
        }

        try {

            // Get a Guzzle client
            $client = Craft::createGuzzleClient();

            // Send a test message to the topic
            $response = $client->post($endpoint, [
                'headers'     => $headers,
                'body'        => Craft::t('notifier', 'Test message from Notifier.'),
                'http_errors' => false,
                'timeout'     => 10,
            ]);

            // Get the response status code
            $status = $response->getStatusCode();

            // If the server rejected the message, bail with an error
            if ($status < 200 || $status >= 300) {
                return $this->asJson([
                    'success' => false,
                    'message' => Craft::t('notifier', 'HTTP {status}', ['status' => $status]),
                ]);
            }

        } catch (Throwable $e) {

            // Request failed, bail with an error
            return $this->asJson([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }

        // Return success
        return $this->asJson([
            'success' => true,
            'message' => Craft::t('notifier', 'Test message sent successfully.'),
        ]);
    }

    /**
     * Send a test message to a specific Slack channel via chat.postMessage.
     *
     * @return Response
     */
    public function actionTestSlack(): Response
    {
        $this->requirePostRequest();
        $this->requireAcceptsJson();

        // Get the posted bot token
        $botToken = App::parseEnv((string) $this->request->getRequiredBodyParam('botToken'));

        // Get the posted channel ID
        $channelId = App::parseEnv(trim((string) $this->request->getRequiredBodyParam('channelId')));

        // If the bot token isn't valid, bail
        if (!OutboundSlack::isValidBotToken($botToken)) {
            return $this->asJson([
                'success' => false,
                'message' => Craft::t('notifier', 'Not a valid Bot Token. Must start with `xoxb-`.'),
            ]);
        }

        // If the channel ID isn't valid, bail
        if (!OutboundSlack::isValidChannelId($channelId)) {
            return $this->asJson([
                'success' => false,
                'message' => Craft::t('notifier', 'Not a valid Channel ID. Must look like `C01234ABCD`.'),
            ]);
        }

        try {

            // Get a Guzzle client
            $client = Craft::createGuzzleClient();

            // Send a test message to the channel
            $response = $client->post('https://slack.com/api/chat.postMessage', [
                'headers'     => [
                    'Authorization' => 'Bearer ' . $botToken,
                    'Content-Type'  => 'application/json; charset=utf-8',
                ],
                'json'        => [
                    'channel' => $channelId,
                    'text'    => 'Notifier test message.',
                    'mrkdwn'  => true,
                ],
                'http_errors' => false,
                'timeout'     => 10,
            ]);

            // Decode the response body
            $decoded = json_decode((string) $response->getBody(), true);

            // If Slack rejected the message, return the error code
            if (!is_array($decoded) || true !== ($decoded['ok'] ?? false)) {

                // Get the error code
                $error = ($decoded['error'] ?? 'unknown');

                return $this->asJson([
                    'success' => false,
                    'message' => Craft::t('notifier', 'Slack rejected the message: {error}', ['error' => $error]),
                ]);
            }

        } catch (Throwable $e) {

            // Request failed, bail with an error
            return $this->asJson([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }

        // Return success
        return $this->asJson([
            'success' => true,
            'message' => Craft::t('notifier', 'Test message sent successfully.'),
        ]);
    }

    /**
     * Send a test message to a specific Discord channel webhook.
     *
     * @return Response
     */
    public function actionTestDiscord(): Response
    {
        $this->requirePostRequest();
        $this->requireAcceptsJson();

        // Get the posted webhook URL
        $webhookUrl = App::parseEnv((string) $this->request->getRequiredBodyParam('webhookUrl'));

        // If the webhook URL isn't valid, bail
        if (!OutboundDiscord::isValidWebhookUrl($webhookUrl)) {
            return $this->asJson([
                'success' => false,
                'message' => Craft::t('notifier', 'Not a valid Webhook URL. Must start with `https://discord.com/api/webhooks/`.'),
            ]);
        }

        try {

            // Get a Guzzle client
            $client = Craft::createGuzzleClient();

            // Send a test message to the webhook
            $response = $client->post($webhookUrl.'?wait=true', [
                'json'        => ['content' => 'Notifier test message.'],
                'http_errors' => false,
                'timeout'     => 10,
            ]);

            // Get the response status code
            $status = $response->getStatusCode();

            // If Discord rejected the message
            if ($status < 200 || $status >= 300) {

                // Decode the response body
                $decoded = json_decode((string) $response->getBody(), true);

                // Get the error message
                $error = (is_array($decoded) ? ($decoded['message'] ?? "HTTP {$status}") : "HTTP {$status}");

                // Message was rejected, bail with an error
                return $this->asJson([
                    'success' => false,
                    'message' => Craft::t('notifier', 'Discord rejected the message: {error}', ['error' => $error]),
                ]);
            }

        } catch (Throwable $e) {

            // Request failed, bail with an error
            return $this->asJson([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }

        // Return success
        return $this->asJson([
            'success' => true,
            'message' => Craft::t('notifier', 'Test message sent successfully.'),
        ]);
    }

    /**
     * Verify a Facebook Page Access Token by reading the Page.
     *
     * @return Response
     */
    public function actionTestFacebook(): Response
    {
        $this->requirePostRequest();
        $this->requireAcceptsJson();

        // Get the posted page ID and token
        $pageId = (string) App::parseEnv((string) $this->request->getRequiredBodyParam('pageId'));
        $token = (string) App::parseEnv((string) $this->request->getRequiredBodyParam('pageAccessToken'));

        // If the page ID or token is empty, bail with an error
        if ('' === trim($pageId) || '' === trim($token)) {
            return $this->asJson([
                'success' => false,
                'message' => Craft::t('notifier', 'Page ID and Page Access Token are required.'),
            ]);
        }

        try {

            // Read the Page's name to verify the token
            $client = Craft::createGuzzleClient();
            $response = $client->get(MetaGraph::endpoint($pageId), [
                'query'       => ['fields' => 'name', 'access_token' => $token],
                'http_errors' => false,
                'timeout'     => 10,
            ]);

            // Decode the response
            $status = $response->getStatusCode();
            $decoded = json_decode((string) $response->getBody(), true);

            // If the Page could not be read, bail with an error
            if ($status < 200 || $status >= 300 || !is_array($decoded) || !isset($decoded['name'])) {
                $error = (is_array($decoded) ? ($decoded['error']['message'] ?? "HTTP {$status}") : "HTTP {$status}");
                return $this->asJson([
                    'success' => false,
                    'message' => Craft::t('notifier', 'Facebook rejected the request: {error}', ['error' => $error]),
                ]);
            }

            // Get the Page name
            $name = $decoded['name'];

        } catch (Throwable $e) {

            // Request failed, bail with an error
            return $this->asJson([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }

        // Return success
        return $this->asJson([
            'success' => true,
            'message' => Craft::t('notifier', 'Successfully connected to "{name}". No posts were made.', ['name' => $name]),
        ]);
    }

    /**
     * Verify an Instagram account by resolving the IG business account linked to the Page.
     *
     * @return Response
     */
    public function actionTestInstagram(): Response
    {
        $this->requirePostRequest();
        $this->requireAcceptsJson();

        // Get the posted page ID and token
        $pageId = (string) App::parseEnv((string) $this->request->getRequiredBodyParam('pageId'));
        $token = (string) App::parseEnv((string) $this->request->getRequiredBodyParam('pageAccessToken'));

        // If the page ID or token is empty, bail with an error
        if ('' === trim($pageId) || '' === trim($token)) {
            return $this->asJson([
                'success' => false,
                'message' => Craft::t('notifier', 'Page ID and Page Access Token are required.'),
            ]);
        }

        // Resolve the linked Instagram business account
        $account = MetaGraph::resolveIgUserId($pageId, $token);

        // If no account is linked, bail with an error
        if (!$account || empty($account['id'])) {
            return $this->asJson([
                'success' => false,
                'message' => Craft::t('notifier', 'No Instagram Business account is linked to this Page.'),
            ]);
        }

        // Get the IG handle (falling back to the account ID)
        $handle = ($account['username'] ?? $account['id']);

        // Return success
        return $this->asJson([
            'success' => true,
            'message' => Craft::t('notifier', 'Successfully connected to @{handle}. No posts were made.', ['handle' => $handle]),
        ]);
    }

    /**
     * Verify X (Twitter) credentials by reading the authenticated account.
     *
     * @return Response
     */
    public function actionTestXTwitter(): Response
    {
        $this->requirePostRequest();
        $this->requireAcceptsJson();

        // Get the posted credentials
        $consumerKey       = (string) App::parseEnv((string) $this->request->getRequiredBodyParam('consumerKey'));
        $consumerKeySecret = (string) App::parseEnv((string) $this->request->getRequiredBodyParam('consumerKeySecret'));
        $accessToken       = (string) App::parseEnv((string) $this->request->getRequiredBodyParam('accessToken'));
        $accessTokenSecret = (string) App::parseEnv((string) $this->request->getRequiredBodyParam('accessTokenSecret'));

        // If any credential is empty, bail with an error
        if (!$consumerKey || !$consumerKeySecret || !$accessToken || !$accessTokenSecret) {
            return $this->asJson([
                'success' => false,
                'message' => Craft::t('notifier', 'All four credentials are required.'),
            ]);
        }

        try {

            // Build the OAuth 1.0a header for the verify request
            $url = 'https://api.x.com/2/users/me';
            $authHeader = OAuth1Signer::authorizationHeader('GET', $url, $consumerKey, $consumerKeySecret, $accessToken, $accessTokenSecret);

            // Read the authenticated account to verify the credentials
            $client = Craft::createGuzzleClient();
            $response = $client->get($url, [
                'headers'     => ['Authorization' => $authHeader],
                'http_errors' => false,
                'timeout'     => 10,
            ]);

            // Decode the response
            $status = $response->getStatusCode();
            $decoded = json_decode((string) $response->getBody(), true);

            // If the credentials didn't verify, bail with an error
            if ($status < 200 || $status >= 300 || !isset($decoded['data']['username'])) {
                $error = (is_array($decoded) ? ($decoded['detail'] ?? $decoded['title'] ?? "HTTP {$status}") : "HTTP {$status}");
                return $this->asJson([
                    'success' => false,
                    'message' => Craft::t('notifier', 'X (Twitter) rejected the request: {error}', ['error' => $error]),
                ]);
            }

            // Get the authenticated username
            $username = $decoded['data']['username'];

        } catch (Throwable $e) {

            // Request failed, bail with an error
            return $this->asJson([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }

        // Return success
        return $this->asJson([
            'success' => true,
            'message' => Craft::t('notifier', 'Successfully authenticated as @{username}. No posts were made.', ['username' => $username]),
        ]);
    }

    /**
     * Verify a Bluesky credential by calling createSession.
     *
     * @return Response
     */
    public function actionTestBluesky(): Response
    {
        $this->requirePostRequest();
        $this->requireAcceptsJson();

        // Get the posted handle
        $handle = (string) App::parseEnv((string) $this->request->getRequiredBodyParam('handle'));

        // Get the posted app password
        $appPassword = (string) App::parseEnv((string) $this->request->getRequiredBodyParam('appPassword'));

        // If the handle or app password is empty, return an error
        if ('' === $handle || '' === $appPassword) {
            return $this->asJson([
                'success' => false,
                'message' => Craft::t('notifier', 'Handle and app password are required.'),
            ]);
        }

        // Get the plugin settings
        /** @var Settings $settings */
        $settings = NotifierPlugin::$plugin->getSettings();

        // Get the PDS URL, falling back to the default
        $pdsUrl = App::parseEnv($settings->blueskyPdsUrl) ?: Settings::DEFAULT_PDS_URL;

        // Verify the credential by creating a session
        $err = null;
        $session = BlueskySession::createSession($pdsUrl, $handle, $appPassword, $err);

        // If authentication failed, bail with an error
        if (!$session) {
            return $this->asJson([
                'success' => false,
                'message' => $err ?: Craft::t('notifier', 'Authentication failed.'),
            ]);
        }

        return $this->asJson([
            'success' => true,
            'message' => Craft::t('notifier', 'Successfully authenticated. No messages were posted.'),
        ]);
    }

    /**
     * Verify a Mastodon credential by calling verify_credentials.
     *
     * @return Response
     */
    public function actionTestMastodon(): Response
    {
        $this->requirePostRequest();
        $this->requireAcceptsJson();

        // Get the posted instance URL
        $instanceUrl = App::parseEnv((string) $this->request->getRequiredBodyParam('instanceUrl'));

        // Get the posted access token
        $accessToken = App::parseEnv((string) $this->request->getRequiredBodyParam('accessToken'));

        // If the instance URL or access token is empty, bail with an error
        if (!$instanceUrl || !$accessToken) {
            return $this->asJson([
                'success' => false,
                'message' => Craft::t('notifier', 'Instance URL and access token are required.'),
            ]);
        }

        try {

            // Get a Guzzle client
            $client = Craft::createGuzzleClient();

            // Verify the credentials against the Mastodon instance
            $response = $client->get(rtrim($instanceUrl, '/').'/api/v1/accounts/verify_credentials', [
                'headers'     => ['Authorization' => 'Bearer '.$accessToken],
                'http_errors' => false,
                'timeout'     => 10,
            ]);

            // Get the response status code
            $status = $response->getStatusCode();

            // Decode the response body
            $decoded = json_decode((string) $response->getBody(), true);

            // If the credentials didn't verify
            if ($status < 200 || $status >= 300 || !is_array($decoded) || !isset($decoded['username'])) {

                // Get the error message
                $error = (is_array($decoded) ? ($decoded['error'] ?? "HTTP {$status}") : "HTTP {$status}");

                // Credentials didn't verify, bail with an error
                return $this->asJson([
                    'success' => false,
                    'message' => Craft::t('notifier', 'Mastodon rejected the request: {error}', ['error' => $error]),
                ]);
            }

            // Get the authenticated account handle
            $handle = $decoded['username'];

        } catch (Throwable $e) {

            // Request failed, bail with an error
            return $this->asJson([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }

        // Return success
        return $this->asJson([
            'success' => true,
            'message' => Craft::t('notifier', 'Successfully authenticated as @{handle}. No posts were made.', ['handle' => $handle]),
        ]);
    }

    /**
     * Publish a test message to a specific MQTT topic via the saved broker settings.
     *
     * @return Response
     */
    public function actionTestMqtt(): Response
    {
        $this->requirePostRequest();
        $this->requireAcceptsJson();

        // Get the posted topic
        $topic = (string) $this->request->getRequiredBodyParam('topic');

        // If the topic isn't a valid publish topic, bail
        if (!OutboundMqtt::isValidTopic($topic)) {
            return $this->asJson([
                'success' => false,
                'message' => Craft::t('notifier', 'Not a valid topic. Must not be empty or contain the `+` or `#` wildcards.'),
            ]);
        }

        // Get the plugin settings
        /** @var Settings $settings */
        $settings = NotifierPlugin::$plugin->getSettings();

        // Get the broker host
        $host = App::parseEnv($settings->mqttHost);

        // If no broker host is configured, return an error
        if (!$host) {
            return $this->asJson([
                'success' => false,
                'message' => Craft::t('notifier', 'Broker host is not configured.'),
            ]);
        }

        // Whether to connect over TLS
        $useTls = (bool) $settings->mqttUseTls;

        // Get the port, defaulting to 8883 for TLS or 1883 for plain
        $port = ($settings->mqttPort ?: ($useTls ? 8883 : 1883));

        // Get the client ID, generating a unique one when empty
        $clientId = (App::parseEnv($settings->mqttClientId) ?: 'notifier-'.uniqid());

        // Get the protocol level, defaulting to 3.1.1
        $protocol = ($settings->mqttProtocolLevel ?: MqttClient::MQTT_3_1_1);

        try {

            // Build the MQTT client
            $client = new MqttClient($host, (int) $port, $clientId, $protocol);

            // Build the connection settings
            $connectionSettings = (new ConnectionSettings())
                ->setUsername(App::parseEnv($settings->mqttUsername) ?: null)
                ->setPassword(App::parseEnv($settings->mqttPassword) ?: null)
                ->setKeepAliveInterval(60)
                ->setConnectTimeout(10)
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

            // Connect, publish a test message, and disconnect
            $client->connect($connectionSettings, true);
            $client->publish($topic, Craft::t('notifier', 'Test message from Notifier.'), 0, false);
            $client->disconnect();

        } catch (Throwable $e) {

            // Connection failed, bail with an error
            return $this->asJson([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }

        // Return success
        return $this->asJson([
            'success' => true,
            'message' => Craft::t('notifier', 'Test message sent successfully.'),
        ]);
    }

    // ========================================================================= //
    // Helpers
    // ========================================================================= //

    /**
     * Render a settings sub-page through the shared layout.
     *
     * @param string $section
     * @param string $title
     * @return Response
     */
    private function _renderSubPage(string $section, string $title): Response
    {
        // Get the file-based config for override-warning display
        $configFile = Craft::$app->getConfig()->getConfigFromFile('notifier');

        return $this->renderTemplate('notifier/_settings/_layout', [
            'section'    => $section,
            'title'      => $title,
            'configFile' => $configFile,
            'settings'   => NotifierPlugin::$plugin->getSettings(),
        ]);
    }

    /**
     * Resolve and cache each Instagram row's linked IG business account ID.
     *
     * Runs on save so dispatch never has to re-resolve the account.
     *
     * @param array $rows Instagram account rows (already carrying UIDs).
     * @return array
     */
    private function _resolveInstagramIgUserIds(array $rows): array
    {
        // Loop through every row
        foreach ($rows as $i => $row) {

            // If the row isn't an array, skip it
            if (!is_array($row)) {
                continue;
            }

            // Resolve the page ID and token
            $pageId = (string) App::parseEnv((string) ($row['pageId'] ?? ''));
            $token = (string) App::parseEnv((string) ($row['pageAccessToken'] ?? ''));

            // If either is missing, skip resolution for this row
            if ('' === $pageId || '' === $token) {
                continue;
            }

            // Resolve the linked Instagram business account and cache its ID
            $account = MetaGraph::resolveIgUserId($pageId, $token);
            if ($account && !empty($account['id'])) {
                $rows[$i]['igUserId'] = $account['id'];
            }

        }

        // Return the rows with resolved IG user IDs
        return $rows;
    }

    /**
     * Ensure every row in a named-list has a stable UID.
     *
     * @param mixed $rows Posted rows, or an empty string when the editable table has no rows.
     * @return array
     */
    private function _assignUids(mixed $rows): array
    {
        // If the editable table was empty it posts a string, so normalize to an array
        if (!is_array($rows)) {
            return [];
        }

        // Editable-table posts arrive keyed by row position; reindex
        $rows = array_values($rows);

        // Loop through every row
        foreach ($rows as $i => $row) {
            // If the row isn't an array, skip it
            if (!is_array($row)) {
                continue;
            }
            // Add a UID if missing or blank
            if (empty($row['uid'])) {
                $rows[$i]['uid'] = StringHelper::UUID();
            }
        }

        // Return the rows with stable UIDs
        return $rows;
    }

}
