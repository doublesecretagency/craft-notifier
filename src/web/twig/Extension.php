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

namespace doublesecretagency\notifier\web\twig;

use doublesecretagency\notifier\helpers\Notifier;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

class Extension extends AbstractExtension implements GlobalsInterface
{

    /**
     * @inheritdoc
     */
    public function getGlobals(): array
    {
        return ['notifier' => new Notifier()];
    }

}
