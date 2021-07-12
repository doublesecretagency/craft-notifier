<?php
/**
 * Notifier plugin for Craft CMS
 *
 * Get notified when things happen.
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

namespace doublesecretagency\notifier\records;

use craft\db\ActiveRecord;
use yii\db\ActiveQueryInterface;

/**
 * Class Trigger
 * @since 1.0.0
 */
class Trigger extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName(): string
    {
        return '{{%notifier_triggers}}';
    }

    /**
     * Returns the trigger’s messages.
     *
     * @return ActiveQueryInterface The relational query object.
     */
    public function getMessages(): ActiveQueryInterface
    {
        return $this->hasMany(Message::class, ['triggerId' => 'id']);
    }

}
