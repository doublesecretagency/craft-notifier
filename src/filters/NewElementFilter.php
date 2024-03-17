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

namespace doublesecretagency\notifier\filters;

use Craft;
use craft\events\ElementEvent;
use craft\events\ModelEvent;
use yii\base\Event;

/**
 * Filters events based on whether the element is propagating
 *
 * @author Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @see https://github.com/craftcms/webhooks
 * @since 1.1.0
 */
class NewElementFilter extends BaseElementFilter
{
    public static function displayName(): string
    {
        return Craft::t('notifier', 'Element is new');
    }

    public static function titleYes(): string
    {
        return Craft::t('notifier', 'New elements only');
    }

    public static function titleNo(): string
    {
        return Craft::t('notifier', 'Existing elements only');
    }

    public static function check(Event $event, bool $value): bool
    {
        if (
            $event instanceof ModelEvent ||
            $event instanceof ElementEvent
        ) {
            return (bool)$event->isNew === $value;
        }

        return true;
    }
}
