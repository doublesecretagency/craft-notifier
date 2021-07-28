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

use craft\elements\Entry;
use doublesecretagency\notifier\helpers\Notifier;
use yii\base\InvalidConfigException;

/**
 * Class Trigger
 * @since 1.0.0
 */
class Trigger extends BaseNotification
{

    /**
     * @var string Corresponding Craft Event.
     */
    public $event;

    // ========================================================================= //

    /**
     * Get messages related to this trigger.
     *
     * @return array
     */
    public function getMessages(): array
    {
        // Return all related Message Models
        return Notifier::getTriggerMessages($this);
    }

    // ========================================================================= //

    /**
     * Check whether an Entry trigger is valid.
     *
     * @param $event
     * @return bool
     * @throws InvalidConfigException
     */
    public function validateEntry($event): bool
    {
        // Get entry
        /** @var Entry $entry */
        $entry = $event->sender;

        // Get individual config values
        $freshness = ($this->config['freshness'] ?? false);
        $drafts    = ($this->config['drafts']    ?? false);
        $sections  = ($this->config['sections']  ?? false);

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
            // If the Entry's section ID isn't selected, mark invalid
            $id = $entry->getSection()->id;
            if (!in_array($id, $sections)) {
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
