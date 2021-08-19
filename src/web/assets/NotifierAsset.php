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

namespace doublesecretagency\notifier\web\assets;

use craft\web\AssetBundle;
use craft\web\assets\vue\VueAsset;

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

        $this->depends = [
            VueAsset::class,
        ];

        $this->css = [
            'css/notifier.css',
        ];

        $this->js = [
            'js/notifier.js',
        ];
    }

}
