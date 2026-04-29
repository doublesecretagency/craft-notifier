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

namespace doublesecretagency\notifier\elements\conditions;

use craft\elements\conditions\ElementCondition;

/**
 * Notification condition
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
     * Resolve the parent's default rule list against whichever override hook
     * the active Craft version actually exposes, then merge in any plugin-
     * specific rules.
     *
     * Calling `parent::conditionRuleTypes()` directly under Craft 5 would throw
     * (the method was removed). Calling `parent::selectableConditionRules()`
     * directly under Craft 4 would also throw (the method didn't exist yet).
     * The `method_exists()` guards select whichever is real on the active version.
     *
     * @return array
     */
    private function _buildRules(): array
    {
        // Pull the parent's default rules from the version-appropriate hook
        $base = [];
        if (method_exists(parent::class, 'selectableConditionRules')) {
            $base = parent::selectableConditionRules();
        } elseif (method_exists(parent::class, 'conditionRuleTypes')) {
            $base = parent::conditionRuleTypes();
        }

        // Merge with any plugin-specific rules (none yet)
        return array_merge($base, [
            // ...
        ]);
    }

}
