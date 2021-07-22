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

namespace doublesecretagency\notifier\web\assets;

use craft\web\AssetBundle;

/**
 * Class NotifierAsset
 * @since 1.0.0
 */
class NotifierAsset extends AssetBundle
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->sourcePath = '@doublesecretagency/notifier/resources';

        $this->css = [
            'css/notifier.css',
        ];
    }

}
