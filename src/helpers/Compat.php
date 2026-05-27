<?php
/**
 * Notifier plugin for Craft CMS
 *
 * First-class Notifications for Craft CMS
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

namespace doublesecretagency\notifier\helpers;

use Craft;

/**
 * Class Compat
 * @since 3.0.0
 *
 * Centralizes the handful of API name differences between Craft 4 and Craft 5
 * so the rest of the plugin can stay version-agnostic. Each helper resolves
 * to a raw string (event name) or a method name suitable for dynamic dispatch
 * (`$obj->{$method}(...)`), avoiding direct references to constants or classes
 * that only exist on one Craft major.
 */
abstract class Compat
{

    /**
     * @var bool|null Cached Craft 5 detection result.
     */
    private static ?bool $_isCraft5 = null;

    // ========================================================================= //

    /**
     * Whether the host Craft install is Craft 5 or higher.
     *
     * @return bool
     */
    public static function isCraft5(): bool
    {
        // Cache on first call (Craft version is fixed for the lifetime of the request)
        return static::$_isCraft5 ??= version_compare(
            Craft::$app->getVersion(),
            '5.0.0',
            '>='
        );
    }

    // ========================================================================= //

    /**
     * Resolve the correct utility-types registration event name for the active Craft version.
     *
     * Craft 5 dispatches `Utilities::EVENT_REGISTER_UTILITIES` (`'registerUtilities'`).
     * Craft 4 dispatched the older `Utilities::EVENT_REGISTER_UTILITY_TYPES` (`'registerUtilityTypes'`).
     *
     * Raw string literals are used (not class constants) because referencing a
     * constant that doesn't exist on the loaded Craft version is a fatal error.
     * The string values are part of Craft's stable internal contract, they're
     * what the framework dispatches against.
     *
     * @return string
     */
    public static function utilitiesEventName(): string
    {
        return static::isCraft5() ? 'registerUtilities' : 'registerUtilityTypes';
    }

    /**
     * Resolve the correct element table-attribute-html event name for the active Craft version.
     *
     * Craft 5 dispatches `Element::EVENT_DEFINE_ATTRIBUTE_HTML` (`'defineAttributeHtml'`).
     * Craft 4 dispatched `Element::EVENT_SET_TABLE_ATTRIBUTE_HTML` (`'setTableAttributeHtml'`).
     *
     * @return string
     */
    public static function defineAttributeHtmlEventName(): string
    {
        return static::isCraft5() ? 'defineAttributeHtml' : 'setTableAttributeHtml';
    }

    /**
     * Resolve the correct CpScreenResponseBehavior method name for the meta sidebar.
     *
     * Craft 5 exposes `metaSidebarTemplate(...)`.
     * Craft 4 exposed `sidebarTemplate(...)`.
     *
     * The signatures are otherwise identical, so callers dynamically dispatch:
     * `$response->{Compat::metaSidebarMethodName()}($template, $vars)`.
     *
     * @return string
     */
    public static function metaSidebarMethodName(): string
    {
        return static::isCraft5() ? 'metaSidebarTemplate' : 'sidebarTemplate';
    }

    /**
     * Resolve the correct condition-rules registration event name for the active Craft version.
     *
     * Craft 5 dispatches `BaseCondition::EVENT_REGISTER_CONDITION_RULES` (`'registerConditionRules'`).
     * Craft 4 dispatched `BaseCondition::EVENT_REGISTER_CONDITION_RULE_TYPES` (`'registerConditionRuleTypes'`).
     *
     * @return string
     */
    public static function conditionRulesEventName(): string
    {
        return static::isCraft5() ? 'registerConditionRules' : 'registerConditionRuleTypes';
    }

    /**
     * Resolve the correct event property name carrying the condition rules array.
     *
     * Craft 5's `RegisterConditionRulesEvent` exposes `$conditionRules`.
     * Craft 4's `RegisterConditionRuleTypesEvent` exposed `$conditionRuleTypes`.
     *
     * Read and write through the resolved name: `$event->{Compat::conditionRulesPropertyName()}`.
     *
     * @return string
     */
    public static function conditionRulesPropertyName(): string
    {
        return static::isCraft5() ? 'conditionRules' : 'conditionRuleTypes';
    }

}
