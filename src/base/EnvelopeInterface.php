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

namespace doublesecretagency\notifier\base;

/**
 * EnvelopeInterface defines how an outbound message must be structured.
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
