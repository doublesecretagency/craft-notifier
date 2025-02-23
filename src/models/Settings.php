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

    // ========================================================================= //

    /**
     * TWIG SANDBOX SECURITY POLICY
     * @see https://plugins.doublesecretagency.com/notifier/messages/twig-sandbox
     */

    /**
     * @var string Set the mode for integrating blacklist/whitelist options:
     *  - 'append': Add to the existing list of options. (default)
     *  - 'override': Replace the existing list of options.
     *  - 'disabled': Bypass the sandbox entirely.
     */
    public string $twigSandboxMode = 'append';

    /**
     * @var array Custom blacklist security policy.
     *
     * Will either "append" or "override" default blacklist,
     * based on the specified `twigSandboxMode`.
     */
    public array $twigSandboxBlacklist = [];

    /**
     * @var array Custom whitelist security policy.
     *
     * Will either "append" or "override" default whitelist,
     * based on the specified `twigSandboxMode`.
     */
    public array $twigSandboxWhitelist = [];

    // ========================================================================= //

    /**
     * @deprecated in 1.1.0
     * @var array|false Original setting for adjusting the default Twig sandbox configuration.
     */
    public array|false $twigSandbox = [];

}
