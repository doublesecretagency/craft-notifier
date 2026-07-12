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

namespace doublesecretagency\notifier\elements\conditions;

use craft\elements\conditions\ElementCondition;

/**
 * Condition for filtering notifications on the element index.
 *
 * @since 1.0.0
 */
class NotificationCondition extends ElementCondition
{

    /**
     * @inheritdoc
     *
     * Craft 4 hook. Craft 4's `BaseCondition` calls this method to collect
     * the available rule types for the condition builder. Untouched by Craft 5.
     *
     * @return array
     */
    protected function conditionRuleTypes(): array
    {
        return $this->_buildRules();
    }

    /**
     * @inheritdoc
     *
     * Craft 5 hook. Craft 5's `BaseCondition` calls this method to collect
     * the available rule types for the condition builder. Untouched by Craft 4.
     *
     * @return array
     */
    protected function selectableConditionRules(): array
    {
        return $this->_buildRules();
    }

    // ========================================================================= //

    /**
     * Build the condition rule list for the active Craft version.
     *
     * Each parent hook exists in only one Craft version (Craft 5 dropped `conditionRuleTypes()`,
     * Craft 4 lacked `selectableConditionRules()`), so `method_exists()` guards pick whichever is real.
     *
     * @return array
     */
    private function _buildRules(): array
    {
        // Initialize the parent's default rules
        $base = [];

        // If the parent exposes the rules hook, pull from it
        if (method_exists(parent::class, 'selectableConditionRules')) {
            $base = parent::selectableConditionRules();
        } elseif (method_exists(parent::class, 'conditionRuleTypes')) {
            $base = parent::conditionRuleTypes();
        }

        // Merge with any plugin-specific rules
        return array_merge($base, [
            // ...
        ]);
    }

}
