<?php
/**
 * Notifier plugin for Craft CMS
 *
 * First-class Notifications for Craft CMS.
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

namespace doublesecretagency\notifier\models;

use Craft;
use craft\base\Model;
use craft\helpers\StringHelper;
use doublesecretagency\notifier\web\twig\Extension;
use nystudio107\crafttwigsandbox\twig\BaseSecurityPolicy;
use nystudio107\crafttwigsandbox\twig\BlacklistSecurityPolicy;
use nystudio107\crafttwigsandbox\twig\WhitelistSecurityPolicy;
use nystudio107\crafttwigsandbox\web\SandboxView;

/**
 * Secure Twig environment for rendering message bodies.
 *
 * @since 1.1.0
 */
class Sandbox extends Model
{

    /**
     * @var string The 'list' config option selecting a blacklist security policy.
     *
     * Default blacklist:
     * https://github.com/nystudio107/craft-twig-sandbox/blob/v5/src/twig/BlacklistSecurityPolicy.php
     */
    public const BLACKLIST = 'blacklist'; // Default

    /**
     * @var string The 'list' config option selecting a whitelist security policy.
     *
     * Default whitelist:
     * https://github.com/nystudio107/craft-twig-sandbox/blob/v5/src/twig/WhitelistSecurityPolicy.php
     */
    public const WHITELIST = 'whitelist';

    /**
     * @var string The 'mode' config option to ADD Twig values to the security policy.
     */
    public const ADD = 'add'; // Default

    /**
     * @var string The 'mode' config option to REMOVE Twig values from the security policy.
     */
    public const REMOVE = 'remove';

    /**
     * @var string The 'mode' config option to REPLACE the security policy with the specified Twig values.
     */
    public const REPLACE = 'replace';

    /**
     * @var string The 'mode' config option to DISABLE the security policy entirely.
     */
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

        // Set the configured sandbox view, registering the Notifier Twig extension so plugin
        // tags (`{% skipMessage %}`, `{% setRecipients %}`) work inside the sandbox, in every mode
        $this->view = new SandboxView([
            'securityPolicy' => $this->securityPolicy,
            'twigExtensionClasses' => [
                Extension::class,
            ],
        ]);
    }

    /**
     * Configure the security policy.
     *
     * @return void
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
