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

namespace doublesecretagency\notifier\conditions\operators;

/**
 * Holds the "has changed" operator value shared by the operator traits.
 *
 * @since 3.1.4
 */
interface HasChangedOperatorInterface
{

    /**
     * @var string Operator value injected into the rule's operator dropdown.
     */
    public const OPERATOR_HAS_CHANGED = 'has_changed';

}
