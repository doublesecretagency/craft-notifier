<?php
/**
 * Notifier plugin for Craft CMS
 *
 * Send custom Twig messages when Craft events get triggered.
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

namespace doublesecretagency\notifier\controllers;

use Craft;
use craft\web\Controller;
use doublesecretagency\notifier\records\Log;
use yii\web\BadRequestHttpException;
use yii\web\Response;

/**
 * Log controller
 * @since 1.0.0
 */
class LogController extends Controller
{

    /**
     * Delete a log event (aka envelope).
     *
     * @return Response
     * @throws BadRequestHttpException
     */
    public function actionDelete(): Response
    {
        $this->requirePostRequest();
        $this->requireAcceptsJson();

        // Get specified ID
        $envelopeId = $this->request->getRequiredBodyParam('id');

        // If no valid ID provided
        if (!$envelopeId || !is_numeric($envelopeId)) {
            // Return JSON response with error message
            return $this->asJson([
                'message' => 'Invalid log event ID.',
                'success' => false,
            ]);
        }

        // Delete all log rows for envelope
        $success = (bool) Log::deleteAll([
            'or',
            ['id' => $envelopeId],
            ['envelopeId' => $envelopeId]
        ]);

        // Return JSON response
        return $this->asJson([
            'message' => ($success ? null : 'Nothing deleted, no matching log events.'),
            'success' => $success,
        ]);
    }

    /**
     * Delete all log events for specified day.
     *
     * @return Response
     * @throws BadRequestHttpException
     */
    public function actionDeleteDay(): Response
    {
        $this->requirePostRequest();
        $this->requireAcceptsJson();

        // Get specified date
        $date = $this->request->getRequiredBodyParam('date');

        // If no date specified
        if (!$date) {
            // Return JSON response with error message
            return $this->asJson([
                'message' => 'No date specified.',
                'success' => false,
            ]);
        }

        // Delete all log rows for envelope
        $success = (bool) Log::deleteAll(
            ["DATE(CONVERT_TZ(dateCreated, 'UTC', :timeZone))" => $date],
            [':timeZone' => Craft::$app->timeZone]
        );

        // If successful
        if ($success) {
            // Display success flash message
            $this->setSuccessFlash(Craft::t('notifier', 'Log events deleted.'));
        }

        // Return JSON response
        return $this->asJson([
            'message' => ($success ? null : 'Nothing deleted, no matching log events.'),
            'success' => $success,
        ]);
    }

}
