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
use craft\web\Controller;
use doublesecretagency\notifier\NotifierPlugin;
use yii\web\BadRequestHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\Response;
use yii\web\ServiceUnavailableHttpException;

/**
 * Run time-based triggers via a web endpoint.
 * @since 3.0.0
 */
class ScheduledController extends Controller
{

    /**
     * @var array|int|bool Allow anonymous access to the run action (cron isn't logged in).
     */
    protected array|int|bool $allowAnonymous = ['run'];

    /**
     * @var bool Disable CSRF validation; the cron caller has no CSRF token.
     */
    public $enableCsrfValidation = false;

    /**
     * Require a POST request and a valid shared-secret token before running.
     *
     * @param mixed $action
     * @return bool
     * @throws BadRequestHttpException if the request is not a POST request.
     * @throws ForbiddenHttpException if the token is missing or incorrect.
     * @throws ServiceUnavailableHttpException if no token is configured.
     */
    public function beforeAction($action): bool
    {
        // Run the standard pre-action checks
        if (!parent::beforeAction($action)) {
            return false;
        }

        // The run must be triggered by a POST request
        $this->requirePostRequest();

        // Get the configured shared secret
        $configured = App::parseEnv(
            NotifierPlugin::getInstance()->getSettings()->scheduledToken
        );

        // If no token is configured, the endpoint is unavailable
        if (!$configured) {
            throw new ServiceUnavailableHttpException('The scheduled-run endpoint is not configured.');
        }

        // Get the request service
        $request = Craft::$app->getRequest();

        // Get the token from the header, falling back to a body param
        $provided = ($request->getHeaders()->get('X-Notifier-Token') ?? $request->getBodyParam('token'));

        // If the token is missing or wrong, deny access
        if (!$provided || !hash_equals((string) $configured, (string) $provided)) {
            throw new ForbiddenHttpException();
        }

        return true;
    }

    /**
     * Run the schedule and dispatch any notifications that are due.
     *
     * @return Response The run summary as JSON.
     */
    public function actionRun(): Response
    {
        // Run the schedule and return the summary as JSON
        return $this->asJson(
            NotifierPlugin::getInstance()->scheduleRunner->run()
        );
    }

}
