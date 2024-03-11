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

namespace doublesecretagency\notifier\jobs;

use craft\i18n\Translation;
use craft\queue\BaseJob;
use doublesecretagency\notifier\base\EnvelopeInterface;

/**
 * Class SendMessage
 * @since 1.0.0
 */
class SendMessage extends BaseJob
{

    /**
     * @var EnvelopeInterface The fully compiled outbound message.
     */
    public EnvelopeInterface $envelope;

    /**
     * Run the queue job.
     *
     * @param $queue
     * @return void
     */
    public function execute($queue): void
    {
        // Attempt to send the message
        $success = $this->envelope->send();

        // If sending was unsuccessful
        if (!$success) {
            // Spawn a new queue job
        }
    }

    /**
     * Description of queue job.
     *
     * @return string
     */
    protected function defaultDescription(): string
    {
        return Translation::prep('notifier', 'Sending {messageType} to {recipient}', [
            'messageType' => ($this->envelope->jobInfo['messageType'] ?? 'unspecified message'),
            'recipient'   => ($this->envelope->jobInfo['recipient']   ?? 'unknown recipient'),
        ]);
    }

}
