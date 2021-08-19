<?php
/**
 * Notifier plugin for Craft CMS
 *
 * Send custom Twig messages when Craft events get triggered.
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

namespace doublesecretagency\notifier\records;

use craft\db\ActiveRecord;
use yii\db\ActiveQueryInterface;

/**
 * Class Message
 * @since 1.0.0
 */
class Message extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName(): string
    {
        return '{{%notifier_messages}}';
    }

    /**
     * Returns the message’s trigger.
     *
     * @return ActiveQueryInterface The relational query object.
     */
    public function getTrigger(): ActiveQueryInterface
    {
        return $this->hasOne(Trigger::class, ['id' => 'triggerId']);
    }

}
