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

namespace doublesecretagency\notifier\models;

use Craft;
use craft\base\Chippable;
use craft\base\CpEditable;
use craft\base\FieldLayoutProviderInterface;
use craft\base\Iconic;
use craft\helpers\UrlHelper;
use craft\models\FieldLayout;
use doublesecretagency\notifier\NotifierPlugin;

/**
 * Field layout provider for the notification field layout (Craft 5 only).
 *
 * @since 3.2.0
 */
class NotificationFieldLayoutProvider implements FieldLayoutProviderInterface, Chippable, CpEditable, Iconic
{

    /**
     * @inheritdoc
     */
    public static function get(string|int $id): ?static
    {
        return new static();
    }

    /**
     * @inheritdoc
     */
    public function getId(): string|int|null
    {
        return 'notifier';
    }

    /**
     * @inheritdoc
     */
    public function getHandle(): ?string
    {
        return 'notifier';
    }

    /**
     * @inheritdoc
     */
    public function getUiLabel(): string
    {
        return Craft::t('notifier', 'Notifications');
    }

    /**
     * @inheritdoc
     */
    public function getFieldLayout(): FieldLayout
    {
        return NotifierPlugin::getInstance()->fieldLayouts->getLayout();
    }

    /**
     * @inheritdoc
     */
    public function getCpEditUrl(): ?string
    {
        return UrlHelper::cpUrl('settings/plugins/notifier/fields');
    }

    /**
     * @inheritdoc
     */
    public function getIcon(): ?string
    {
        return NotifierPlugin::getInstance()->getBasePath().DIRECTORY_SEPARATOR.'icon-mask.svg';
    }

}
