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
use craft\helpers\StringHelper;
use nystudio107\crafttwigsandbox\twig\BaseSecurityPolicy;
use nystudio107\crafttwigsandbox\twig\BlacklistSecurityPolicy;
use nystudio107\crafttwigsandbox\twig\WhitelistSecurityPolicy;
use nystudio107\crafttwigsandbox\web\SandboxView;

/**
 * Class Sandbox
 * @since 1.1.0
 */
class Sandbox extends Model
{

    /**
     * @var Settings The plugin settings.
     */
    public Settings $settings;

    /**
     * @var BaseSecurityPolicy|null The security policy.
     */
    public ?BaseSecurityPolicy $securityPolicy = null;

    /**
     * @var SandboxView|null The sandboxed Twig view.
     */
    public ?SandboxView $view = null;

    /**
     * @var array List of all Twig types.
     */
    public array $twigTypes = [
        'tags',
        'filters',
        'functions',
        'methods',
        'properties'
    ];

    // ========================================================================= //

    /**
     * Initialize the sandboxed Twig environment.
     *
     * @return void
     */
    public function init(): void
    {
        // Run parent init
        parent::init();

        // If a whitelist is specified
        if ($this->settings->twigSandboxWhitelist) {

            // Create a new whitelist
            $this->securityPolicy = new WhitelistSecurityPolicy();

            // Get specified whitelist config values
            $config = $this->settings->twigSandboxWhitelist;

        // Else, use blacklist by default
        } else {

            // Create a new blacklist
            $this->securityPolicy = new BlacklistSecurityPolicy();

            // Get specified blacklist config values
            $config = $this->settings->twigSandboxBlacklist ?? [];

        }

        // Configure the security policy
        $this->_configurePolicy($config);

        // Set configured sandbox view
        $this->view = new SandboxView([
            'securityPolicy' => $this->securityPolicy
        ]);
    }

    /**
     * Configure the security policy.
     *
     * @param array $config
     */
    private function _configurePolicy(array $config): void
    {
        // Get the sandbox mode
        $mode = ($this->settings->twigSandboxMode ?? 'append');

        // If set to "override" mode
        if ('override' === $mode) {

            // Override security policy for all Twig types
            foreach ($this->twigTypes as $type) {
                $this->_override($config, $type);
            }

        // Else, if set to "except" mode
        } else if ('except' === $mode) {

            // Remove exceptions from security policy for all Twig types
            foreach ($this->twigTypes as $type) {
                $this->_except($config, $type);
            }

        // Else, assume "append" mode
        } else {

            // Append values to security policy for all Twig types
            foreach ($this->twigTypes as $type) {
                $this->_append($config, $type);
            }

        }
    }

    // ========================================================================= //

    /**
     * Append values to the security policy for this Twig type.
     *
     * @param array $config
     * @param string $type
     * @return void
     */
    private function _append(array $config, string $type): void
    {
        // Get specified config values
        $specified = $config[$type] ?? [];

        // Get uppercase version of type
        $ucType = StringHelper::toTitleCase($type);

        // Methods
        $getTwig = "getTwig{$ucType}";
        $setTwig = "setTwig{$ucType}";

        // Get existing values
        $values = $this->securityPolicy->$getTwig();

        // Optionally append Twig values
        if (isset($specified) && is_array($specified)) {
            // Merge existing values with specified values
            $values = array_merge($values, $specified);
        }

        // Set the specified Twig type
        $this->securityPolicy->$setTwig($values);
    }

    /**
     * Remove exceptions from the security policy for this Twig type.
     *
     * @param array $config
     * @param string $type
     * @return void
     */
    private function _except(array $config, string $type): void
    {
        // Get specified config values
        $specified = $config[$type] ?? [];

        // Get uppercase version of type
        $ucType = StringHelper::toTitleCase($type);

        // Methods
        $getTwig = "getTwig{$ucType}";
        $setTwig = "setTwig{$ucType}";

        // Get existing values
        $values = $this->securityPolicy->$getTwig();

        // Optionally remove Twig values
        if (isset($specified) && is_array($specified)) {
            // Remove specified values from existing values
            $values = array_diff($values, $specified);
        }

        // Set the specified Twig type
        $this->securityPolicy->$setTwig($values);
    }

    /**
     * Override the security policy for this Twig type.
     *
     * @param array $config
     * @param string $type
     * @return void
     */
    private function _override(array $config, string $type): void
    {
        // Get specified config values
        $specified = $config[$type] ?? [];

        // Get uppercase version of type
        $ucType = StringHelper::toTitleCase($type);

        // Method
        $setTwig = "setTwig{$ucType}";

        // If specified in config
        if (isset($specified) && is_array($specified)) {

            // Set the specified Twig type
            $this->securityPolicy->$setTwig($specified);

        }
    }

}
