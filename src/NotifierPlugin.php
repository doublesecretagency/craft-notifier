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

namespace doublesecretagency\notifier;

use craft\base\Plugin;

/**
 * Class NotifierPlugin
 * @since 1.0.0
 */
class NotifierPlugin extends Plugin
{

    /**
     * @var string Current schema version of the plugin.
     */
    public $schemaVersion = '0.0.0';

    /**
     * @var Plugin Self-referential plugin property.
     */
    public static $plugin;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;
    }

}
