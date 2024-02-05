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

use craft\base\Model;

/**
 * Class Settings
 * @since 1.0.0
 */
class Settings extends Model
{

    /**
     * @var string|null Twilio Account SID.
     */
    public ?string $twilioAccountSid = null;

    /**
     * @var string|null Twilio Auth Token.
     */
    public ?string $twilioAuthToken = null;

    /**
     * @var string|null Twilio phone number (sends each SMS message).
     */
    public ?string $twilioPhoneNumber = null; // FROM

    /**
     * @var string|null Recipient phone number for testing purposes.
     */
    public ?string $testToPhoneNumber = null; // TO

}
