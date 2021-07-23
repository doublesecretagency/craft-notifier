<?php
/**
 * Notifier plugin for Craft CMS
 *
 * Get notified when things happen.
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

namespace doublesecretagency\notifier\models;

use craft\base\Model;
use craft\helpers\Json;

/**
 * Class BaseNotification
 * @since 1.0.0
 */
class BaseNotification extends Model
{

    /**
     * @var int ID of notification component.
     */
    public $id;

    /**
     * @var string Raw configuration of notification component.
     */
    public $configRaw;

    // ========================================================================= //

    /**
     * Get config as an array.
     *
     * @return array
     */
    public function getConfig(): array
    {
        // Get config
        $configRaw = ($this->configRaw ?? '[]');

        // Check if JSON is valid
        // Must use this function to validate (I know it's redundant)
        /** @noinspection PhpComposerExtensionStubsInspection */
        $valid = json_decode($configRaw);

        // Convert config data to an array
        return ($valid ? Json::decode($configRaw) : []);
    }

}
