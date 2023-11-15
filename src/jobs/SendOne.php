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

namespace doublesecretagency\notifier\jobs;

use Craft;
use craft\queue\BaseJob;
use craft\mail\Message;
use yii\queue\RetryableJobInterface;

/**
 * Class SendOne (aka RetryRecipient)
 * @since 1.0.0
 */
class SendOne extends BaseJob implements RetryableJobInterface
{

    public function execute($queue): void
    {
        $message = new Message();

        /**
         * Send a SINGLE message
         * to a SINGLE recipient
         */

        $message->setTo(getenv('TEST_EMAIL'));
        $message->setSubject('Oh Hai');
        $message->setTextBody('Hello from the queue system! 👋');

        Craft::$app->getMailer()->send($message);
    }

    protected function defaultDescription(): string
    {
        return Craft::t('app', 'Sending a worthless email');
    }

    /**
     * @return int time to reserve in seconds
     */
    public function getTtr(): int
    {
        // TODO: Implement getTtr() method.
        return 60;
    }

    /**
     * @param int $attempt number
     * @param \Exception|\Throwable $error from last execute of the job
     * @return bool
     */
    public function canRetry($attempt, $error): bool
    {
        // TODO: Implement canRetry() method.
        return false;
    }
}
