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
use doublesecretagency\notifier\base\EnvelopeInterface;

/**
 * Class OutboundAnnouncement
 * @since 1.0.0
 */
class OutboundAnnouncement extends Model implements EnvelopeInterface
{

    /**
     * @var array
     */
    public array $jobInfo = [];

    /**
     * @var string
     */
    public string $title = '';

    /**
     * @var string
     */
    public string $message = '';

    /**
     * @var bool
     */
    public bool $adminsOnly = false;

    /**
     * Send the announcement.
     *
     * @return bool
     */
    public function send(): bool
    {
        // Send the announcement
        Craft::$app->getAnnouncements()->push(
            $this->title,
            $this->message,
            'notifier',
            $this->adminsOnly
        );

//        // Log success message
//        Log::success("The announcement to {$this->to} was sent successfully! ({$this->title})");

        // Return successfully
        return true;
    }

}
