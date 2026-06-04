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

namespace doublesecretagency\notifier\filters;

use Craft;
use craft\base\Component;
use craft\base\ElementInterface;
use craft\events\ElementEvent;
use craft\services\Elements;
use yii\base\Event;
use yii\base\NotSupportedException;

/**
 * Base filter for elements.
 *
 * @see https://github.com/craftcms/webhooks
 * @since 1.1.0
 */
abstract class BaseElementFilter extends Component implements ExclusiveFilterInterface
{

    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t('notifier', 'Unnamed filter');
    }

    /**
     * @inheritdoc
     */
    public static function titleYes(): string
    {
        return Craft::t('notifier', 'Must be TRUE to send message');
    }

    /**
     * @inheritdoc
     */
    public static function titleNo(): string
    {
        return Craft::t('notifier', 'Must be FALSE to send message');
    }

    /**
     * @inheritdoc
     */
    public static function titleIgnore(): string
    {
        return Craft::t('notifier', 'No effect');
    }

    /**
     * @inheritdoc
     */
    public static function defaultValue(): ?bool
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public static function show(string $class, string $event): bool
    {
        return (is_subclass_of($class, ElementInterface::class) || (
                $class === Elements::class &&
                in_array($event, [
                    Elements::EVENT_BEFORE_DELETE_ELEMENT,
                    Elements::EVENT_AFTER_DELETE_ELEMENT,
                    Elements::EVENT_BEFORE_RESTORE_ELEMENT,
                    Elements::EVENT_AFTER_RESTORE_ELEMENT,
                    Elements::EVENT_BEFORE_SAVE_ELEMENT,
                    Elements::EVENT_AFTER_SAVE_ELEMENT,
                    Elements::EVENT_BEFORE_UPDATE_SLUG_AND_URI,
                    Elements::EVENT_AFTER_UPDATE_SLUG_AND_URI,
                ], true)
            ));
    }

    /**
     * @inheritdoc
     */
    public static function excludes(): array
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public static function check(Event $event, bool $value): bool
    {
        if ($event->sender instanceof ElementInterface) {
            return static::checkElement($event->sender, $value);
        }

        if ($event instanceof ElementEvent) {
            return static::checkElement($event->element, $value);
        }

        throw new NotSupportedException(Craft::t('notifier', 'Invalid element event: {class}', ['class' => get_class($event)]));
    }

    /**
     * Whether the element passes the filter.
     *
     * @param ElementInterface $element
     * @param bool $value
     * @return bool
     */
    protected static function checkElement(ElementInterface $element, bool $value): bool
    {
        return true;
    }

}
