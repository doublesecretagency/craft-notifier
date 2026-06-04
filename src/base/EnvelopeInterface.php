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

namespace doublesecretagency\notifier\base;

/**
 * Defines how an outbound message must be structured.
 *
 * @since 1.0.0
 */
interface EnvelopeInterface
{

    /**
     * Attempt to send the message.
     *
     * @return bool Whether message was sent successfully.
     */
    public function send(): bool;

}
