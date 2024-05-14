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

namespace doublesecretagency\notifier\fieldlayoutelements\notifications;

use Craft;
use craft\base\ElementInterface;
use craft\fieldlayoutelements\BaseNativeField;
use doublesecretagency\notifier\elements\Notification;

/**
 * Recipients field layout element
 * @since 1.1.0
 */
class RecipientsFieldLayoutElement extends BaseNativeField
{

    /**
     * @inheritdoc
     */
    public string $attribute = 'recipients';

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

        return Craft::$app->getView()->renderTemplate('notifier/notifications/_edit/recipients', [
            'notification' => $element,
        ]);
    }

}
