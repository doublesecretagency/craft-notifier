<?php

/**
 * Notifier Twig Sandbox Configuration
 *
 * Copy this file to:
 * /config/notifier-sandbox.php
 *
 * For complete details on configuring the Twig sandbox, visit:
 * https://plugins.doublesecretagency.com/notifier/messages/twig-sandbox
 */

use doublesecretagency\notifier\models\Sandbox;

return [

    // Which list to use
    'list' => Sandbox::BLACKLIST,

    // Which mode to use
    'mode' => Sandbox::REMOVE,

    // Twig adjustments for the sandbox
    'twig' => [
        'tags' => ['include']
    ]

];
