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

namespace doublesecretagency\notifier\web\assets;

use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * Class FiltersAsset
 * @since 1.1.0
 */
class FiltersAsset extends AssetBundle
{

    /**
     * @inheritdoc
     */
    public function init(): void
    {
        parent::init();

        $this->sourcePath = '@doublesecretagency/notifier/web/assets/dist';

        $this->depends = [
            CpAsset::class,
        ];

        $this->css = [
            'css/filters.css',
        ];

        $this->js = [
            'js/filters.js',
        ];
    }

}
