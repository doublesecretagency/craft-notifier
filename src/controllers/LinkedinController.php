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
use craft\helpers\UrlHelper;
use craft\web\Controller;
use doublesecretagency\notifier\NotifierPlugin;
use yii\web\Response;

/**
 * Runs the LinkedIn OAuth connect flow.
 *
 * @since 3.1.0
 */
class LinkedinController extends Controller
{

    /**
     * @var array|int|bool Allow anonymous access to the callback, since LinkedIn returns without a CSRF token.
     */
    protected array|int|bool $allowAnonymous = ['callback'];

    /**
     * @var bool Disable CSRF validation; the OAuth callback carries no CSRF token, so the state token is the guard.
     */
    public $enableCsrfValidation = false;

    /**
     * @var string Session key holding the OAuth state token.
     */
    private const STATE_KEY = 'notifier.linkedin.state';

    // ========================================================================= //

    /**
     * Begin the OAuth flow by redirecting the admin to LinkedIn.
     *
     * @return Response
     */
    public function actionConnect(): Response
    {
        // Only admins can connect a LinkedIn account
        $this->requireAdmin();

        // Generate a random state token for CSRF defense
        $state = Craft::$app->getSecurity()->generateRandomString(32);

        // Store the state in the session for the callback to validate
        Craft::$app->getSession()->set(self::STATE_KEY, $state);

        // Build the authorize URL
        $authorizeUrl = NotifierPlugin::getInstance()->linkedinConnections->authorizeUrl($state);

        // If the app isn't configured, flash an error and return to settings
        if (!$authorizeUrl) {
            Craft::$app->getSession()->setError(Craft::t('notifier', 'Add your LinkedIn app credentials before connecting.'));
            return $this->redirect($this->_settingsUrl());
        }

        // Redirect the browser out to LinkedIn
        return $this->redirect($authorizeUrl);
    }

    /**
     * Handle the OAuth callback from LinkedIn.
     *
     * @return Response
     */
    public function actionCallback(): Response
    {
        // Get the request service
        $request = Craft::$app->getRequest();

        // Get the session service
        $session = Craft::$app->getSession();

        // If LinkedIn returned an error (e.g. the user denied access), flash it and bail
        if ($error = $request->getQueryParam('error')) {
            $description = $request->getQueryParam('error_description', $error);
            $session->setError(Craft::t('notifier', 'LinkedIn authorization failed: {error}', ['error' => $description]));
            return $this->redirect($this->_settingsUrl());
        }

        // Get the returned state and the expected state
        $returnedState = (string) $request->getQueryParam('state');
        $expectedState = (string) $session->get(self::STATE_KEY);

        // Clear the stored state so it can't be replayed
        $session->remove(self::STATE_KEY);

        // If the state doesn't match, reject the callback
        if (!$expectedState || !hash_equals($expectedState, $returnedState)) {
            $session->setError(Craft::t('notifier', 'LinkedIn authorization failed: invalid state.'));
            return $this->redirect($this->_settingsUrl());
        }

        // Get the authorization code
        $code = (string) $request->getQueryParam('code');

        // If no code was returned, reject the callback
        if (!$code) {
            $session->setError(Craft::t('notifier', 'LinkedIn authorization failed: no code returned.'));
            return $this->redirect($this->_settingsUrl());
        }

        // Exchange the code and persist any resulting connections
        $error = null;
        $created = NotifierPlugin::getInstance()->linkedinConnections->createConnectionsFromCode($code, $error);

        // If no connections were created, flash the error
        if (!$created) {
            $session->setError(Craft::t('notifier', 'LinkedIn authorization failed: {error}', ['error' => ($error ?: 'unknown error')]));
            return $this->redirect($this->_settingsUrl());
        }

        // Flash success and return to settings
        $session->setNotice(Craft::t('notifier', 'Connected to LinkedIn.'));
        return $this->redirect($this->_settingsUrl());
    }

    /**
     * Disconnect a LinkedIn connection.
     *
     * @return Response|null
     */
    public function actionDisconnect(): ?Response
    {
        // Only admins can disconnect a LinkedIn account
        $this->requireAdmin();

        // The disconnect must be a POST request
        $this->requirePostRequest();

        // Get the connection UID to delete
        $uid = (string) $this->request->getRequiredBodyParam('uid');

        // Delete the connection
        NotifierPlugin::getInstance()->linkedinConnections->deleteConnection($uid);

        // Flash success and return to settings
        Craft::$app->getSession()->setNotice(Craft::t('notifier', 'Disconnected from LinkedIn.'));
        return $this->redirectToPostedUrl();
    }

    // ========================================================================= //

    /**
     * Get the URL of the LinkedIn settings sub-page.
     *
     * @return string
     */
    private function _settingsUrl(): string
    {
        return UrlHelper::cpUrl('settings/plugins/notifier/linkedin');
    }

}
