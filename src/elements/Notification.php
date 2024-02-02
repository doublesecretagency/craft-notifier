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

namespace doublesecretagency\notifier\elements;

use Craft;
use craft\base\Element;
use craft\elements\User;
use craft\elements\conditions\ElementConditionInterface;
use craft\helpers\UrlHelper;
use craft\web\CpScreenResponseBehavior;
use doublesecretagency\notifier\elements\conditions\NotificationCondition;
use doublesecretagency\notifier\elements\db\NotificationQuery;
use doublesecretagency\notifier\NotifierPlugin;
use doublesecretagency\notifier\records\Notification as NotificationRecord;
use yii\base\Event;
use yii\base\Exception as BaseException;
use yii\web\Response;

/**
 * Notification element type
 * @since 1.0.0
 */
class Notification extends Element
{

    /**
     * @var string|null Optional description of the notification.
     */
    public ?string $description = null;

    /**
     * @var bool Whether to dispatch notifications via the jobs queue (vs bypass the queue and send immediately).
     */
    public bool $useQueue = true;

    /**
     * @var string|null Type of event which will activate the notification.
     */
    public ?string $eventType = null;

    /**
     * @var string|null Specific event which will activate the notification.
     */
    public ?string $event = null;

    /**
     * @var array Event configuration details.
     */
    public array $eventConfig = [];

    /**
     * @var string|null Type of message to send. (ie: email, text)
     */
    public ?string $messageType = null;

    /**
     * @var array Message configuration details.
     */
    public array $messageConfig = [];

    /**
     * @var string|null Type of recipients. (ie: Admins)
     */
    public ?string $recipientsType = null;

    /**
     * @var array Message configuration details.
     */
    public array $recipientsConfig = [];

    // ========================================================================= //

    public static function displayName(): string
    {
        return Craft::t('notifier', 'Notification');
    }

    public static function pluralDisplayName(): string
    {
        return Craft::t('notifier', 'Notifications');
    }

    public static function refHandle(): ?string
    {
        return 'notification';
    }

    public static function hasContent(): bool
    {
        return true;
    }

    public static function hasTitles(): bool
    {
        return true;
    }

    public static function hasStatuses(): bool
    {
        return true;
    }

    public static function find(): NotificationQuery
    {
        return Craft::createObject(NotificationQuery::class, [static::class]);
    }

    public static function createCondition(): ElementConditionInterface
    {
        return Craft::createObject(NotificationCondition::class, [static::class]);
    }

    protected static function defineSources(string $context): array
    {
        return [
            [
                'key' => '*',
                'label' => Craft::t('notifier', 'All notifications'),
            ],
        ];
    }

    protected static function defineActions(string $source): array
    {
        // List any bulk element actions here
        return [];
    }

    protected static function includeSetStatusAction(): bool
    {
        return true;
    }

    protected static function defineSortOptions(): array
    {
        return [
            'title' => Craft::t('app', 'Title'),
            'slug' => Craft::t('app', 'Slug'),
            'uri' => Craft::t('app', 'URI'),
            [
                'label' => Craft::t('app', 'Date Created'),
                'orderBy' => 'elements.dateCreated',
                'attribute' => 'dateCreated',
                'defaultDir' => 'desc',
            ],
            [
                'label' => Craft::t('app', 'Date Updated'),
                'orderBy' => 'elements.dateUpdated',
                'attribute' => 'dateUpdated',
                'defaultDir' => 'desc',
            ],
            [
                'label' => Craft::t('app', 'ID'),
                'orderBy' => 'elements.id',
                'attribute' => 'id',
            ],
            // ...
        ];
    }

    protected static function defineTableAttributes(): array
    {
        return [
            'slug' => ['label' => Craft::t('app', 'Slug')],
            'uri'  => ['label' => Craft::t('app', 'URI')],

            'description'    => ['label' => Craft::t('app', 'Description')],
            'useQueue'       => ['label' => Craft::t('app', 'Use Queue')],
            'eventType'      => ['label' => Craft::t('app', 'Event Type')],
            'event'          => ['label' => Craft::t('app', 'Event')],
            'messageType'    => ['label' => Craft::t('app', 'Message Type')],
            'recipientsType' => ['label' => Craft::t('app', 'Recipients Type')],

            'id'          => ['label' => Craft::t('app', 'ID')],
            'uid'         => ['label' => Craft::t('app', 'UID')],
            'dateCreated' => ['label' => Craft::t('app', 'Date Created')],
            'dateUpdated' => ['label' => Craft::t('app', 'Date Updated')],
        ];
    }

    protected static function defineDefaultTableAttributes(string $source): array
    {
        return [
            'description',
            'eventType',
            'event',
            'messageType',
            'recipientsType',
            'useQueue',
        ];
    }

    protected function defineRules(): array
    {
        return array_merge(parent::defineRules(), [
            // ...
        ]);
    }

    public function canView(User $user): bool
    {
        if (parent::canView($user)) {
            return true;
        }
        // todo: implement user permissions
        return $user->can('viewNotifications');
    }

    public function canSave(User $user): bool
    {
        if (parent::canSave($user)) {
            return true;
        }
        // todo: implement user permissions
        return $user->can('saveNotifications');
    }

    public function canDuplicate(User $user): bool
    {
        if (parent::canDuplicate($user)) {
            return true;
        }
        // todo: implement user permissions
        return $user->can('saveNotifications');
    }

    public function canDelete(User $user): bool
    {
        if (parent::canSave($user)) {
            return true;
        }
        // todo: implement user permissions
        return $user->can('deleteNotifications');
    }

    public function canCreateDrafts(User $user): bool
    {
        return true;
    }

    protected function cpEditUrl(): ?string
    {
        return sprintf('notifications/%s', $this->getCanonicalId());
    }

    public function getPostEditUrl(): ?string
    {
        return UrlHelper::cpUrl('notifications');
    }

    public function prepareEditScreen(Response $response, string $containerId): void
    {
        /** @var Response|CpScreenResponseBehavior $response */
        $response->crumbs([
            [
                'label' => self::pluralDisplayName(),
                'url' => UrlHelper::cpUrl('notifications'),
            ],
        ]);
    }

    // ========================================================================= //

    /**
     * @inheritdoc
     * @throws BaseException
     */
    public function afterSave(bool $isNew): void
    {
        // If not propagating
        if (!$this->propagating) {

            // Get the notification record
            if (!$isNew) {
                $record = NotificationRecord::findOne($this->id);

                if (!$record) {
                    throw new BaseException('Invalid notification ID: '.$this->id);
                }
            } else {
                $record = new NotificationRecord();
                $record->id = $this->id;
            }

            // Save to the `notifier_notifications` table
            $record->description      = $this->description;
            $record->useQueue         = $this->useQueue;
            $record->eventType        = $this->eventType;
            $record->event            = $this->event;
            $record->eventConfig      = $this->eventConfig;
            $record->messageType      = $this->messageType;
            $record->messageConfig    = $this->messageConfig;
            $record->recipientsType   = $this->recipientsType;
            $record->recipientsConfig = $this->recipientsConfig;

            $record->save(false);
        }

        parent::afterSave($isNew);
    }

    // ========================================================================= //

    /**
     * Send this Notification based on the activated Event.
     *
     * @param Event $event
     * @return void
     */
    public function send(Event $event): void
    {
        NotifierPlugin::getInstance()->messages->send($this, $event);
    }

}
