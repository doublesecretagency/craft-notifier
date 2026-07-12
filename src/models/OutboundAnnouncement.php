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

namespace doublesecretagency\notifier\models;

use Craft;
use craft\db\Table;
use craft\helpers\Db;
use DateTime;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\helpers\Notifier;

/**
 * Envelope for an outbound announcement.
 *
 * @since 1.0.0
 */
class OutboundAnnouncement extends BaseEnvelope
{

    /**
     * @var int|null ID of the User who should receive this announcement.
     */
    public ?int $userId = null;

    /**
     * @var string|null Display name of the recipient, for the success log.
     */
    public ?string $recipientName = null;

    /**
     * @var int|null ID of the Notifier plugin row, resolved once at compile time and carried per envelope so each queue job avoids re-querying.
     */
    public ?int $pluginId = null;

    /**
     * @var string Announcement heading.
     */
    public string $title = '';

    /**
     * @var string Announcement body.
     */
    public string $message = '';

    /**
     * Send the announcement.
     *
     * @return bool
     */
    public function send(): bool
    {
        // Get original notification
        /** @var Notification $notification */
        $notification = Notifier::getNotification($this->notificationId);

        // If invalid notification, bail
        if (!$notification) {
            return false;
        }

        // If no userId specified, log error and bail
        if (!$this->userId) {
            $notification->log->error(Craft::t('notifier', '[NO RECIPIENT] No recipient user was specified for the announcement.'), $this->envelopeId);
            return false;
        }

        // Insert one announcement row for the targeted user
        Craft::$app->getDb()->createCommand()
            ->insert(Table::ANNOUNCEMENTS, [
                'userId'      => $this->userId,
                'pluginId'    => $this->pluginId,
                'heading'     => $this->title,
                'body'        => $this->message,
                'dateCreated' => Db::prepareDateForDb(new DateTime()),
            ])
            ->execute();

        // Log success message
        $notification->log->success(Craft::t('notifier', 'Successfully posted an announcement for {name}.', ['name' => $this->recipientName]), $this->envelopeId);

        // Return successfully
        return true;
    }

}
