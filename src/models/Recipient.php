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

        // If user was specified without an email address
        if ($this->user && !$this->emailAddress) {
            // Get email address from user
            $this->emailAddress = $this->user->email;
        }

    }

    /**
     * Get recipient's name or email address.
     *
     * @return string
     */
    public function __toString(): string
    {
        // Return recipient's name or email address
        return ($this->user->getName() ?? $this->emailAddress ?? '');
    }

}
