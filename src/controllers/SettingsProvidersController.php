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

namespace doublesecretagency\notifier\controllers;

use Craft;
use craft\helpers\App;
use craft\helpers\StringHelper;
use craft\web\Controller;
use doublesecretagency\notifier\helpers\BlueskySession;
use doublesecretagency\notifier\models\OutboundSlack;
use doublesecretagency\notifier\models\Settings;
use doublesecretagency\notifier\NotifierPlugin;
use Throwable;
use yii\web\BadRequestHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\Response;

/**
 * Settings Providers controller
 * @since 3.0.0
 *
 * Powers the Notifier settings pages. Each provider gets its own page;
 * this controller shows them, saves changes, and runs the per-row Test buttons.
 */
class SettingsProvidersController extends Controller
{

    /**
     * @inheritdoc
     */
    public array|bool|int $allowAnonymous = false;

    /**
     * Require admin access for every action in this controller (mirrors Craft's settings gating).
     *
     * @inheritdoc
     */
    public function beforeAction($action): bool
    {
        // Bail if parent rejects
        if (!parent::beforeAction($action)) {
            return false;
        }

        // Only admins (or users with admin-equivalent settings access) can manage plugin settings
        $this->requireAdmin();

        return true;
    }

    // ========================================================================= //
    // Render actions (one per sub-page)
    // ========================================================================= //

    /**
     * Render the General sub-page (logging settings).
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
     * Render the Pushover sub-page.
     *
     * @return Response
     */
    public function actionPushover(): Response
    {
        return $this->_renderSubPage('pushover', 'Pushover');
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

        // Whitelist sections (no surprises)
        $whitelist = ['general', 'twilio', 'pushover', 'ntfy', 'slack', 'bluesky'];
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
        if ('bluesky' === $section && isset($posted['blueskyAccounts'])) {
            $posted['blueskyAccounts'] = $this->_assignUids($posted['blueskyAccounts']);
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

        $topic = (string) $this->request->getRequiredBodyParam('topic');

        // Validate
        if ('' === trim($topic)) {
            return $this->asJson(['success' => false, 'message' => Craft::t('notifier', 'Topic is empty.')]);
        }

        /** @var Settings $settings */
        $settings = NotifierPlugin::$plugin->getSettings();

        $serverUrl = App::parseEnv($settings->ntfyServerUrl);
        if (!$serverUrl) {
            return $this->asJson(['success' => false, 'message' => Craft::t('notifier', 'Server URL is not configured.')]);
        }

        $endpoint = rtrim($serverUrl, '/').'/'.$topic;

        // Build headers
        $headers = ['Title' => 'Notifier test'];
        $token = App::parseEnv($settings->ntfyAccessToken);
        if ($token) {
            $headers['Authorization'] = "Bearer {$token}";
        }

        try {
            $client = Craft::createGuzzleClient();
            $response = $client->post($endpoint, [
                'headers'     => $headers,
                'body'        => Craft::t('notifier', 'Test message from Notifier.'),
                'http_errors' => false,
                'timeout'     => 10,
            ]);
            $status = $response->getStatusCode();

            if ($status < 200 || $status >= 300) {
                return $this->asJson(['success' => false, 'message' => Craft::t('notifier', 'HTTP {status}', ['status' => $status])]);
            }
        } catch (Throwable $e) {
            return $this->asJson(['success' => false, 'message' => $e->getMessage()]);
        }

        return $this->asJson(['success' => true, 'message' => Craft::t('notifier', 'Test message sent successfully.')]);
    }

    /**
     * Send a test message to a specific Slack webhook.
     *
     * @return Response
     */
    public function actionTestSlack(): Response
    {
        $this->requirePostRequest();
        $this->requireAcceptsJson();

        // Resolve the posted value (supports a $ENV_VAR reference)
        $webhookUrl = App::parseEnv((string) $this->request->getRequiredBodyParam('webhookUrl'));

        // Validate
        if (!OutboundSlack::isValidWebhookUrl($webhookUrl)) {
            return $this->asJson(['success' => false, 'message' => Craft::t('notifier', "Not a valid Webhook URL. Must start with https://hooks.slack.com/services/")]);
        }

        try {
            $client = Craft::createGuzzleClient();
            $response = $client->post($webhookUrl, [
                'headers'     => ['Content-Type' => 'application/json'],
                'json'        => ['text' => 'Notifier test message.', 'mrkdwn' => true],
                'http_errors' => false,
                'timeout'     => 10,
            ]);
            $status = $response->getStatusCode();
            $body = trim((string) $response->getBody());

            if (200 !== $status || 'ok' !== $body) {
                return $this->asJson(['success' => false, 'message' => Craft::t('notifier', 'HTTP {status}: {body}', ['status' => $status, 'body' => $body])]);
            }
        } catch (Throwable $e) {
            return $this->asJson(['success' => false, 'message' => $e->getMessage()]);
        }

        return $this->asJson(['success' => true, 'message' => Craft::t('notifier', 'Test message sent successfully.')]);
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

        $handle = (string) $this->request->getRequiredBodyParam('handle');

        // Resolve the posted app password (supports a $ENV_VAR reference)
        $appPassword = (string) App::parseEnv((string) $this->request->getRequiredBodyParam('appPassword'));

        if ('' === $handle || '' === $appPassword) {
            return $this->asJson(['success' => false, 'message' => Craft::t('notifier', 'Handle and app password are required.')]);
        }

        /** @var Settings $settings */
        $settings = NotifierPlugin::$plugin->getSettings();
        $pdsUrl = App::parseEnv($settings->blueskyPdsUrl) ?: Settings::DEFAULT_PDS_URL;

        $err = null;
        $session = BlueskySession::createSession($pdsUrl, $handle, $appPassword, $err);

        if (!$session) {
            return $this->asJson(['success' => false, 'message' => $err ?: Craft::t('notifier', 'Authentication failed.')]);
        }

        return $this->asJson(['success' => true, 'message' => Craft::t('notifier', 'Successfully authenticated. No messages were posted.')]);
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
     * Ensure every row in a named-list has a stable UID.
     *
     * @param array $rows
     * @return array
     */
    private function _assignUids(array $rows): array
    {
        // Editable-table posts arrive keyed by row position; reindex
        $rows = array_values($rows);

        foreach ($rows as $i => $row) {
            if (!is_array($row)) {
                continue;
            }
            // Add a UID if missing or blank
            if (empty($row['uid'])) {
                $rows[$i]['uid'] = StringHelper::UUID();
            }
        }

        return $rows;
    }

}
