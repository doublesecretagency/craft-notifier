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

namespace doublesecretagency\notifier\web\twig;

use doublesecretagency\notifier\helpers\Notifier;
use doublesecretagency\notifier\web\twig\tokenparsers\SkipMessageTokenParser;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

/**
 * Class MessageExtension
 * @since 1.0.0
 */
class MessageExtension extends AbstractExtension implements GlobalsInterface
{

    /**
     * Registers message variables.
     *
     * @return array
     */
    public function getGlobals(): array
    {
        return [
            'notifier' => new Notifier(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function getTokenParsers(): array
    {
        return [
            new SkipMessageTokenParser(),
        ];
    }


}
