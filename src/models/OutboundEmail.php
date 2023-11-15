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
     * @var string|null
     */
    public ?string $subject = null;

    /**
     * @var string|null
     */
    public ?string $body = null;

    /**
     * Send the email message.
     */
    public function send(): bool
    {

        // HOORAY, IT WORKS!!
//        Craft::dd([
//            'to' => $this->to,
//            'subject' => $this->subject,
//            'body' => $this->body,
////            'success' => $success,
////            'error' => $email,
//        ]);


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
