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
use craft\mail\Message as Email;
use doublesecretagency\notifier\base\EnvelopeInterface;
use yii\base\InvalidConfigException;

/**
 * Class OutboundEmail
 * @since 1.0.0
 */
class OutboundEmail extends Model implements EnvelopeInterface
{

    /**
     * @var string|null
     */
    public ?string $to = null;

    /**
     * @var string
     */
    public string $subject = '';

    /**
     * @var string
     */
    public string $body = '';

    /**
     * Send the email message.
     *
     * @return bool
     * @throws InvalidConfigException
     */
    public function send(): bool
    {
        // If no recipient specified, log warning and bail
        if (!$this->to) {
//            Log::warning("Unable to send email, no recipient specified.");
            return false;
        }

        // Compile email
        $email = new Email();
        $email->setTo($this->to);
        $email->setSubject($this->subject);
        $email->setHtmlBody($this->body);
        $email->setTextBody($this->body);

        // Send email
        $success = Craft::$app->getMailer()->send($email);

//        // If unsuccessful, log error and bail
//        if (!$success) {
//            Log::warning("Unable to send the email using Craft's native email handling.");
//            Log::error("Check your general email settings within Craft.");
//            return false;
//        }
//
//        // Log success message
//        Log::success("The email to {$this->to} was sent successfully! ({$this->subject})");

        // Return whether message was sent successfully
        return $success;
    }

}
