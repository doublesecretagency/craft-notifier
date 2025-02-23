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

use Craft;
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
     * Config options for 'list':
     *
     * Default blacklist:
     * https://github.com/nystudio107/craft-twig-sandbox/blob/v5/src/twig/BlacklistSecurityPolicy.php
     *
     * Default whitelist:
     * https://github.com/nystudio107/craft-twig-sandbox/blob/v5/src/twig/WhitelistSecurityPolicy.php
     */
    public const BLACKLIST = 'blacklist'; // Default
    public const WHITELIST = 'whitelist';

    /**
     * Config options for 'mode':
     *
     * - ADD specified Twig values to the security policy.
     * - REMOVE specified Twig values from the security policy.
     * - REPLACE the security policy with the specified Twig values.
     * - DISABLE the security policy entirely.
     */
    public const ADD = 'add'; // Default
    public const REMOVE = 'remove';
    public const REPLACE = 'replace';
    public const DISABLE = 'disable';

    // ========================================================================= //

    /**
     * @var array The sandbox configuration.
     */
    public array $config;

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

        // If whitelist is specified
        if (self::WHITELIST === ($this->config['list'] ?? null)) {
            // Create a new whitelist
            $this->securityPolicy = new WhitelistSecurityPolicy();
        } else {
            // Create a new blacklist
            $this->securityPolicy = new BlacklistSecurityPolicy();
        }

        // Configure the security policy
        $this->_configurePolicy();

        // Set configured sandbox view
        $this->view = new SandboxView([
            'securityPolicy' => $this->securityPolicy
        ]);
    }

    /**
     * Configure the security policy.
     */
    private function _configurePolicy(): void
    {
        // Get the sandbox mode
        $mode = ($this->config['mode'] ?? self::ADD);

        // Get the Twig configuration
        $twig = ($this->config['twig'] ?? []);

        // Switch based on mode
        switch ($mode) {

            // Replace the security policy for each Twig type
            case self::REPLACE:
                foreach ($this->twigTypes as $type) {
                    $this->_replace($twig, $type);
                }
                break;

            // Remove values from the security policy for each Twig type
            case self::REMOVE:
                foreach ($this->twigTypes as $type) {
                    $this->_remove($twig, $type);
                }
                break;

            // Add values to the security policy for each Twig type
            default:
                foreach ($this->twigTypes as $type) {
                    $this->_add($twig, $type);
                }

        }
    }

    // ========================================================================= //

    /**
     * Add values to the security policy for this Twig type.
     *
     * @param array $config
     * @param string $type
     * @return void
     */
    private function _add(array $config, string $type): void
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

        // Optionally add Twig values
        if (isset($specified) && is_array($specified)) {
            // Merge existing values with specified values
            $values = array_merge($values, $specified);
        }

        // Set the specified Twig type
        $this->securityPolicy->$setTwig($values);
    }

    /**
     * Remove values from the security policy for this Twig type.
     *
     * @param array $config
     * @param string $type
     * @return void
     */
    private function _remove(array $config, string $type): void
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
     * Replace the security policy for this Twig type.
     *
     * @param array $config
     * @param string $type
     * @return void
     */
    private function _replace(array $config, string $type): void
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
