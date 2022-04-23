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
use craft\helpers\Json;

/**
 * Class BaseNotification
 * @since 1.0.0
 *
 * @property-read array $config
 */
class BaseNotification extends Model
{

    /**
     * @var int|null ID of notification component.
     */
    public ?int $id = null;

    /**
     * @var string|null Raw configuration of notification component.
     */
    public ?string $configRaw = null;

    // ========================================================================= //

    /**
     * Get config as an array.
     *
     * @return array
     */
    public function getConfig(): array
    {
        return $this->_jsonDecode($this->configRaw ?? '[]');
    }

    /**
     * JSON decode results, providing a valid fallback.
     *
     * @param string $results
     * @return array
     */
    protected function _jsonDecode(string $results): array
    {
        // Check if JSON is valid
        // Must use this function to validate (I know it's redundant)
        $valid = json_decode($results);

        // Convert config data to an array
        return ($valid ? Json::decode($results) : []);
    }

}
