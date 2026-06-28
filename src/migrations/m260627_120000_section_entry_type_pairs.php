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

namespace doublesecretagency\notifier\migrations;

use Craft;
use craft\db\Migration;
use craft\db\Query;
use craft\helpers\Json;
use doublesecretagency\notifier\helpers\Compat;

/**
 * Converts the flat entry type filter into per-section entry type pairs.
 *
 * @since 3.1.0
 */
class m260627_120000_section_entry_type_pairs extends Migration
{

    /**
     * @inheritdoc
     */
    public function safeUp(): bool
    {
        // Get every existing Entry notification
        $rows = (new Query())
            ->select(['id', 'eventConfig'])
            ->from('{{%notifier_notifications}}')
            ->where(['eventType' => 'entries'])
            ->all();

        // If no entry notifications exist, nothing to convert
        if (!$rows) {
            return true;
        }

        // Get the entries service (Craft 5: getEntries(), Craft 4: getSections())
        $entriesService = Compat::isCraft5()
            ? Craft::$app->getEntries()
            : Craft::$app->getSections();

        // Loop through each entry notification
        foreach ($rows as $row) {

            // Decode the existing eventConfig
            $eventConfig = Json::decode($row['eventConfig']) ?? [];

            // If already converted, skip
            if (isset($eventConfig['sectionEntryTypes'])) {
                continue;
            }

            // Get the old flat sections and entry types
            $sections   = ($eventConfig['sections'] ?? []);
            $entryTypes = array_map('intval', ($eventConfig['entryTypes'] ?? []));

            // Initialize the section + entry type pairs
            $pairs = [];

            // Loop through each selected section
            foreach ($sections as $sectionId) {

                // Cast the section ID to an integer
                $sectionId = (int) $sectionId;

                // Initialize the section's available entry types
                $availableTypeIds = [];

                // Get the section
                $section = $entriesService->getSectionById($sectionId);

                // If the section exists, collect its entry type IDs
                if ($section) {
                    // Loop through the section's entry types
                    foreach ($section->getEntryTypes() as $entryType) {
                        // Add the entry type ID
                        $availableTypeIds[] = (int) $entryType->id;
                    }
                }

                // Get the entry types to pair with this section: the previously-selected
                // ones, or all of the section's types when none were selected
                $typeIds = $entryTypes
                    ? array_values(array_intersect($availableTypeIds, $entryTypes))
                    : $availableTypeIds;

                // Loop through each resolved entry type
                foreach ($typeIds as $typeId) {
                    // Add the section + entry type pair
                    $pairs[] = "{$sectionId}-{$typeId}";
                }
            }

            // Store the pairs and drop the old flat entry types key
            $eventConfig['sectionEntryTypes'] = $pairs;
            unset($eventConfig['entryTypes']);

            // Persist the updated eventConfig
            $this->update(
                '{{%notifier_notifications}}',
                ['eventConfig' => Json::encode($eventConfig)],
                ['id' => $row['id']],
                [],
                false
            );
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown(): bool
    {
        echo "m260627_120000_section_entry_type_pairs cannot be reverted.\n";
        return false;
    }

}
