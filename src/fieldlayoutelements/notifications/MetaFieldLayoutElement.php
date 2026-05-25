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

namespace doublesecretagency\notifier\fieldlayoutelements\notifications;

use Craft;
use craft\base\ElementInterface;
use craft\fieldlayoutelements\BaseNativeField;
use doublesecretagency\notifier\elements\Notification;

/**
 * Meta field layout element
 * @since 1.1.0
 */
class MetaFieldLayoutElement extends BaseNativeField
{

    /**
     * @inheritdoc
     */
    public string $attribute = 'meta';

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
        if (!$element) {
            return '';
        }

        return Craft::$app->getView()->renderTemplate('notifier/notifications/_edit/meta', [
            'notification' => $element,
        ]);
    }

}
