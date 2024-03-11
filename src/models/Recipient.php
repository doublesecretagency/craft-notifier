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

namespace doublesecretagency\notifier\models;

use craft\base\Model;
use craft\elements\User;

/**
 * Class Recipient
 * @since 1.0.0
 */
class Recipient extends Model
{

    /**
     * @var User|null
     */
    public ?User $user = null;

    /**
     * @var string|null
     */
    public ?string $emailField = null;

    /**
     * @var string|null
     */
    public ?string $smsField = null;

    /**
     * @var string|null
     */
    public ?string $name = null;

    /**
     * @var string|null
     */
    public ?string $emailAddress = null;

    /**
     * @var string|null
     */
    public ?string $phoneNumber = null;

    /**
     * Extract missing data from existing data.
     *
     * @return void
     */
    public function init(): void
    {
        parent::init();

        // Extract relevant data from User
        $this->_extractUserData();
    }

    /**
     * Extract all relevant data from the User.
     *
     * @return void
     */
    private function _extractUserData(): void
    {
        // If no user was specified, bail
        if (!$this->user) {
            return;
        }

        // If no preset name
        if (!$this->name) {
            // Get from the user
            $this->name = $this->user->getName();
        }

        // If no preset email address
        if (!$this->emailAddress) {
            // If an alternate email field was specified
            if ($this->emailField) {
                // Get from alternate email address
                $this->emailAddress = $this->user->{$this->emailField};
            } else {
                // Get from default User email address
                $this->emailAddress = $this->user->email;
            }
        }

        // If no preset phone number and field exists
        if (!$this->phoneNumber && $this->smsField) {
            // Get from User's custom phone number
            $this->phoneNumber = $this->user->{$this->smsField};
        }
    }

    // ========================================================================= //

    /**
     * Get recipient's name or email address.
     *
     * @return string
     */
    public function __toString(): string
    {
        // Return recipient's name or email address
        return ($this->name ?? $this->emailAddress ?? '');
    }

}
