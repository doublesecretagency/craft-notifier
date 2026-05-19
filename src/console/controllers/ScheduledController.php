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
        // Run the schedule
        $summary = NotifierPlugin::getInstance()->scheduleRunner->run();

        // Report each error
        foreach ($summary['errors'] as $error) {
            $this->stderr($error . PHP_EOL, Console::FG_RED);
        }

        // Report the run summary
        $this->stdout(
            "Ran {$summary['notifications']} notification(s), dispatched {$summary['sent']}." . PHP_EOL,
            Console::FG_GREEN
        );
        return ExitCode::OK;
    }

}
