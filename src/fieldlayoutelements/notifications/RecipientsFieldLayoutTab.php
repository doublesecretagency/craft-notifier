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
use craft\models\FieldLayoutTab;

/**
 * Recipients field layout tab
 * @since 1.1.0
 */
class RecipientsFieldLayoutTab extends FieldLayoutTab
{

    /**
     * @inheritdoc
     */
    public function init(): void
    {
        parent::init();

        $this->name = Craft::t('notifier', 'Recipients');
    }

    /**
     * @inheritdoc
     */
    public function getElements(): array
    {
        return [
            new RecipientsFieldLayoutElement(),
        ];
    }

}
