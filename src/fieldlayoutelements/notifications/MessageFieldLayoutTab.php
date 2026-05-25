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
use craft\models\FieldLayoutTab;

/**
 * Message field layout tab
 * @since 1.1.0
 */
class MessageFieldLayoutTab extends FieldLayoutTab
{

    /**
     * @inheritdoc
     */
    public function init(): void
    {
        parent::init();

        $this->name = Craft::t('notifier', 'Message');
    }

    /**
     * @inheritdoc
     */
    public function getElements(): array
    {
        return [
            new MessageFieldLayoutElement(),
        ];
    }

}
