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
use craft\errors\MissingComponentException;
use doublesecretagency\notifier\base\EnvelopeInterface;
use yii\helpers\Markdown;

/**
 * Class OutboundFlash
 * @since 1.0.0
 */
class OutboundFlash extends Model implements EnvelopeInterface
{

    /**
     * @var string
     */
    public string $type = 'notice';

    /**
     * @var string
     */
    public string $title = '';

    /**
     * @var string
     */
    public string $message = '';

    /**
     * Send the flash message.
     *
     * @return bool
     * @throws MissingComponentException
     */
    public function send(): bool
    {
        // Get session services
        $session = Craft::$app->getSession();

        // Set message details
        $details = ['details' => Markdown::process($this->message)];

        // Set flash message according to type
        switch ($this->type) {
            case 'success':
                $session->setSuccess($this->title, $details);
                break;
            case 'notice':
                $session->setNotice($this->title, $details);
                break;
            case 'error':
                $session->setError($this->title, $details);
                break;
            default:
//                Log::warning("Unable to send the flash message, invalid flash type.");
                return false;
        }

//        // Log success message
//        Log::success("The flash message was sent successfully!");

        // Return successfully
        return true;
    }

}
