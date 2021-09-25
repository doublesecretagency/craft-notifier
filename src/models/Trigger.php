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

use craft\elements\Entry;
use craft\helpers\ElementHelper;
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

        // Whether the Entry is a Draft or Revision
        $isDraftRevision = ElementHelper::isDraftOrRevision($entry);

        // Whether to include Drafts and Revisions
        $includeDraftRevision = (bool) ($this->config['includeDraftsAndRevisions'] ?? false);

        // If excluding Drafts & Revisions, and it is a Draft or Revision, mark invalid
        if (!$includeDraftRevision && $isDraftRevision) {
            return false;
        }

        // TODO: Remove legacy `freshness` by v1.0
        // Whether to activate trigger for new entries, existing entries, or both
        $newExisting = ($this->config['freshness'] ?? $this->config['newExisting'] ?? false);
//        $newExisting = ($this->config['newExisting'] ?? false);

        // Simplify logic
        $new          = $entry->firstSave;
        $onlyNew      = ($newExisting === 'new');
        $onlyExisting = ($newExisting === 'existing');

        // Filter by newness
        if ($new) {
            // If new, and only existing are allowed, mark invalid
            if ($onlyExisting) {
                return false;
            }
        } else {
            // If existing, and only new are allowed, mark invalid
            if ($onlyNew) {
                return false;
            }
        }

        // Get selected sections
        $sections = ($this->config['sections'] ?? false);

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
