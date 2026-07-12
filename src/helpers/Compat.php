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

namespace doublesecretagency\notifier\helpers;

use Craft;

/**
 * Centralizes Craft 4 vs 5 API name differences.
 *
 * @since 3.0.0
 */
abstract class Compat
{

    /**
     * @var bool|null Cached Craft 4 detection result.
     */
    private static ?bool $_isCraft4 = null;

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
        // Cache on first call, since the Craft version is fixed for the request
        return static::$_isCraft5 ??= version_compare(
            Craft::$app->getVersion(),
            '5.0.0',
            '>='
        );
    }

    /**
     * Whether the host Craft install is Craft 4.
     *
     * @return bool
     */
    public static function isCraft4(): bool
    {
        // Get the host Craft version
        $version = Craft::$app->getVersion();

        // Cache on first call, since the Craft version is fixed for the request
        return static::$_isCraft4 ??= (
            version_compare($version, '4.0.0', '>=')
            && version_compare($version, '5.0.0', '<')
        );
    }

    // ========================================================================= //

    /**
     * Get the utility-types registration event name for the active Craft version.
     *
     * Craft 5 dispatches `Utilities::EVENT_REGISTER_UTILITIES` (`'registerUtilities'`).
     * Craft 4 dispatched the older `Utilities::EVENT_REGISTER_UTILITY_TYPES` (`'registerUtilityTypes'`).
     *
     * @return string
     */
    public static function utilitiesEventName(): string
    {
        // Raw literals, not class constants: a constant missing on the loaded Craft version would fatal
        return static::isCraft5() ? 'registerUtilities' : 'registerUtilityTypes';
    }

    /**
     * Get the element table-attribute-html event name for the active Craft version.
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
     * Get the CpScreenResponseBehavior method name for the meta sidebar.
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
     * Get the condition-rules registration event name for the active Craft version.
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
     * Get the event property name carrying the condition rules array.
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
