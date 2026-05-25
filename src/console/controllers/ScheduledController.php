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

namespace doublesecretagency\notifier\console\controllers;

use craft\console\Controller;
use craft\helpers\Console;
use doublesecretagency\notifier\NotifierPlugin;
use yii\console\ExitCode;

/**
 * Run time-based triggers from the command line.
 * @since 3.0.0
 */
class ScheduledController extends Controller
{

    /**
     * Run the schedule and dispatch any notifications that are due.
     *
     * Intended to run on a cron schedule, ideally once per minute.
     *
     * Usage:
     *   craft notifier/scheduled/run
     *
     * @return int Exit code.
     */
    public function actionRun(): int
    {
        // Get the plugin instance
        $plugin = NotifierPlugin::getInstance();

        // Run the schedule runner
        $summary = $plugin->scheduleRunner->run();

        // Run the feed runner
        $feed = $plugin->feedRunner->run();

        // Merge the feed runner's results into the summary
        $summary['notifications'] += $feed['notifications'];
        $summary['dispatched']    += $feed['dispatched'];
        $summary['sent']          += $feed['sent'];
        $summary['errors']        = array_merge($summary['errors'], $feed['errors']);

        // Loop through any errors and print each one
        foreach ($summary['errors'] as $error) {
            $this->stderr($error . PHP_EOL, Console::FG_RED);
        }

        // Whether to append a trailing "s" to each count's word
        $s1 = (1 === $summary['notifications'] ? '' : 's');
        $s2 = (1 === $summary['dispatched']    ? '' : 's');

        // Compile the message
        $message = "Ran {$summary['notifications']} notification{$s1}, dispatched {$summary['dispatched']} message{$s2}";

        // If any were dispatched, append number successfully sent
        if ($summary['dispatched']) {
            $message .= ", successfully sent {$summary['sent']}";
        }

        // Print the run summary
        $this->stdout("{$message}." . PHP_EOL, Console::FG_GREEN);

        // Done
        return ExitCode::OK;
    }

}
