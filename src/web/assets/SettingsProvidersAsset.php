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

namespace doublesecretagency\notifier\web\assets;

use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * Registers the CP assets for the provider settings sub-pages.
 *
 * @since 3.0.0
 */
class SettingsProvidersAsset extends AssetBundle
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

        $this->js = [
            'js/settings-providers.js',
        ];

        $this->css = [
            'css/settings-providers.css',
        ];
    }

}
