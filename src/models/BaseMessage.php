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

namespace doublesecretagency\notifier\models;

use Craft;
use craft\base\Model;
use craft\web\View;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\helpers\Log;
use Exception;
use Throwable;
use yii\base\ErrorException;

/**
 * Base Message class
 * @since 1.0.0
 */
class BaseMessage extends Model
{

    /**
     * @var Notification|null Notification which is sending this message.
     */
    protected ?Notification $_notification = null;

    /**
     * @var array|null Relevant data for parsing the message.
     */
    protected ?array $_data = [];

    /**
     * Construct the message model.
     */
    public function __construct(Notification $notification, array $data = [], array $config = [])
    {
        // Get specified values
        $this->_notification = $notification;
        $this->_data = $data;

        // Parent constructor
        parent::__construct($config);
    }

    /**
     * Send the message to all recipients.
     */
    public function send(): void
    {
        // Override this method
    }

    // ========================================================================= //

    /**
     * Parse the message body.
     *
     * @return string|null Returns null if error occurred.
     * @throws ErrorException
     */
    protected function _parseMessageBody(): ?string
    {
        // Get the message template
        $template = $this->_notification->messageTemplate;

        // If template not specified
        if (!$template) {
            // Log warning and bail
            Log::warning("Cannot compile message body, template not specified.");
            return null;
        }

        // Get view services
        $view = Craft::$app->getView();

        // Parse the message body
        try {
            // Render message body template
            $body = $view->renderTemplate($template, $this->_data, View::TEMPLATE_MODE_SITE);
        } catch (Exception $e) {
            // Log warning and bail
            Log::warning("Cannot compile message body from template. {$e->getMessage()}");
            return null;
        }

        // Return body
        return trim($body);
    }

    /**
     * Parse a string using compiled data.
     *
     * @throws ErrorException|Throwable
     */
    protected function _parseString(string $str): string
    {
        // Attempt to parse the string
        try {

            // Get view services
            $view = Craft::$app->getView();

            // Get the element being parsed
            $element = ($this->_data['element'] ?? null);

            // If element exists
            if ($element) {
                // Parse string as an object
                $str = $view->renderObjectTemplate($str, $element, $this->_data, View::TEMPLATE_MODE_SITE);
            } else {
                // Parse string as a non-object
                $str = $view->renderString($str, $this->_data, View::TEMPLATE_MODE_SITE);
            }

        } catch (Exception $e) {

            // Log a warning
            Log::warning("Cannot parse string for message. {$e->getMessage()}");

        }

        // Return the parsed string
        return trim($str);
    }

}
