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

namespace doublesecretagency\notifier\jobs;

use craft\i18n\Translation;
use craft\queue\BaseJob;
use doublesecretagency\notifier\base\EnvelopeInterface;

/**
 * Queue job that sends a single message.
 *
 * @since 1.0.0
 */
class SendMessage extends BaseJob
{

    /**
     * @var EnvelopeInterface The fully compiled outbound message.
     */
    public EnvelopeInterface $envelope;

    /**
     * @inheritdoc
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
     * @inheritdoc
     */
    protected function defaultDescription(): string
    {
        return Translation::prep('notifier', 'Sending {messageType} to {recipient}', [
            'messageType' => ($this->envelope->jobInfo['messageType'] ?? 'unspecified message'),
            'recipient'   => ($this->envelope->jobInfo['recipient']   ?? 'unknown recipient'),
        ]);
    }

}
