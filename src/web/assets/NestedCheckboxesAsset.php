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

namespace doublesecretagency\notifier\web\assets;

use craft\web\AssetBundle;

/**
 * Class NestedCheckboxesAsset
 * @since 1.1.0
 */
class NestedCheckboxesAsset extends AssetBundle
{

    /**
     * @inheritdoc
     */
    public function init(): void
    {
        parent::init();

        $this->sourcePath = '@doublesecretagency/notifier/web/assets/dist';

        $this->css = [
            'css/nested-checkboxes.css',
        ];

        $this->js = [
            'js/nested-checkboxes.js',
        ];
    }

}
