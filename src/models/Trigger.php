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
use doublesecretagency\notifier\records\Message as MessageRecord;

/**
 * Class Trigger
 * @since 1.0.0
 */
class Trigger extends Model
{

    /**
     * @var int ID of link.
     */
    public $id;

    /**
     * @var string Corresponding Craft Event.
     */
    public $event;

    /**
     * @var string Configuration of Event details.
     */
    public $config;

    // ========================================================================= //

    /**
     * Get messages related to this trigger.
     *
     * @return array
     */
    public function getMessages(): array
    {
        // Get all Message Records for this trigger
        $messages = MessageRecord::findAll([
            'triggerId' => $this->id
        ]);

        // Convert each Record into a Model
        array_walk($messages, function (&$value) {

            // Get the Message Record attributes
            $omitColumns = ['dateCreated','dateUpdated','uid'];
            $attr = $value->getAttributes(null, $omitColumns);

            // Convert to a Message Model
            $value = new Message($attr);
        });

        // Return all Message Models
        return $messages;
    }

    // ========================================================================= //

    /**
     * Get trigger configuration.
     *
     * @return array
     */
    public function getConfiguration(): array
    {
        // Get config
        $config = ($this->config ?? '[]');

        // Check if JSON is valid
        // Must use this function to validate (I know it's redundant)
        $valid = json_decode($config);

        // Convert config data to an array
        return ($valid ? Json::decode($config) : []);
    }

}
