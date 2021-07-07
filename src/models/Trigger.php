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

namespace doublesecretagency\notifier\models;

use craft\base\Model;
use DateTime;

/**
 * Class Trigger
 * @since 1.0.0
 */
class Trigger extends Model
{

    /**
     * @var int ID of link.
     */
    public $id;

    /**
     * @var DateTime Date/time link was created.
     */
    public $dateCreated;

    /**
     * @var DateTime Date/time link was updated.
     */
    public $dateUpdated;

    /**
     * @var string Unique row ID.
     */
    public $uid;

}
