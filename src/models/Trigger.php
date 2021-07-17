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
use craft\elements\Entry;
use craft\helpers\Json;
use doublesecretagency\notifier\records\Message as MessageRecord;
use yii\base\InvalidConfigException;

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
            $value = new Message($value->getAttributes());
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

    // ========================================================================= //

    /**
     * Check whether an Entry trigger is valid.
     *
     * @param $config
     * @param $event
     * @return bool
     * @throws InvalidConfigException
     */
    public function validateEntry($config, $event): bool
    {
        // Get entry
        /** @var Entry $entry */
        $entry = $event->sender;

        // Get individual config values
        $freshness = ($config['freshness'] ?? false);
        $drafts    = ($config['drafts']    ?? false);
        $sections  = ($config['sections']  ?? false);

        // If the Entry is new
        // but only existing entries are allowed, mark invalid
        if ($event->isNew && ($freshness === 'existing')) {
            return false;
        }

        // If the Entry is not new
        // but only new entries are allowed, mark invalid
        if (!$event->isNew && ($freshness === 'new')) {
            return false;
        }

        // If the Entry is a draft
        // but only published are allowed, mark invalid
        if ($entry->isDraft && ($drafts === 'published')) {
            return false;
        }

        // If the Entry is not a draft
        // but only drafts are allowed, mark invalid
        if (!$entry->isDraft && ($drafts === 'drafts')) {
            return false;
        }

        // If an array of sections was provided
        if (is_array($sections)) {
            // If the Entry's handle isn't selected, mark invalid
            $handle = $entry->getSection()->handle;
            if (!in_array($handle, $sections)) {
                return false;
            }
        } else {
            // If not allowing all sections, mark invalid
            if ($sections !== '*') {
                return false;
            }
        }

        // Entry event is valid!
        return true;
    }

}
