<?php
/**
 * Notifier plugin for Craft CMS
 *
 * Get notified when things happen.
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

namespace doublesecretagency\notifier\models;

use Craft;
use craft\base\Model;
use craft\mail\Message as Email;
use craft\web\View;
use Exception;
use yii\base\BaseObject;

/**
 * Class Message
 * @since 1.0.0
 */
class Message extends Model
{

    /**
     * @var int ID of message.
     */
    public $id;

    /**
     * @var int ID of related Trigger.
     */
    public $triggerId;

    /**
     * @var string Type of message (Email, SMS, etc).
     */
    public $type;

    /**
     * @var string Template for rendering the message body.
     */
    public $template;

    /**
     * @var string Message subject line (email only).
     */
    public $subject;

    /**
     * @var mixed Collection of message recipients.
     */
    public $recipients;

    // ========================================================================= //

    /**
     * Send the message.
     */
    public function send($data = [])
    {
        switch ($this->type) {
            case 'email':
            default: // TEMP
                $this->_sendEmail($data);
        }
    }

    // ========================================================================= //

    /**
     * Parse the message body.
     */
    private function _getBody($data): string
    {
        // Get view services
        $view = Craft::$app->getView();

        // Attempt to render the Twig template
        try {

            // Render message body template
            $body = $view->renderTemplate($this->template, $data, View::TEMPLATE_MODE_SITE);

            // Return trimmed body text
            return trim($body);

        } catch (Exception $e) {

            // Log an error

            // Return an empty string
            return '';
        }
    }

    // ========================================================================= //

    /**
     * Send the message via email.
     */
    private function _sendEmail($data)
    {
        $body = $this->_getBody($data);

        Craft::dd([
            $this->subject,
            $body,
        ]);



        // Compile email
        $email = new Email();
        $email->setTo('lindsey@doublesecretagency.com');
        $email->setSubject($this->subject);
        $email->setHtmlBody($body);
        $email->setTextBody($body);

        // Send email
        $success = Craft::$app->getMailer()->send($email);


        Craft::dd($success);

    }

}
