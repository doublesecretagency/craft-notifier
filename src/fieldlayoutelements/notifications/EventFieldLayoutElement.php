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

namespace doublesecretagency\notifier\fieldlayoutelements\notifications;

use Craft;
use craft\base\ElementInterface;
use craft\fieldlayoutelements\BaseNativeField;
use doublesecretagency\notifier\elements\Notification;

/**
 * Event settings field in the notification editor.
 *
 * @since 1.1.0
 */
class EventFieldLayoutElement extends BaseNativeField
{

    /**
     * @inheritdoc
     */
    public string $attribute = 'event';

    /**
     * @inheritdoc
     */
    protected function inputHtml(?ElementInterface $element = null, bool $static = false): ?string
    {
        return null;
    }

    /**
     * @inheritdoc
     * @param Notification $element
     */
    public function formHtml(?ElementInterface $element = null, bool $static = false): ?string
    {
        // If there's no element, render nothing
        if (!$element) {
            return '';
        }

        return Craft::$app->getView()->renderTemplate('notifier/notifications/_edit/event', [
            'notification' => $element,
        ]);
    }

}
