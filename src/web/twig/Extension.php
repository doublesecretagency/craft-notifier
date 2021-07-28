<?php
/**
 * Notifier plugin for Craft CMS
 *
 * Get notified when things happen.
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

namespace doublesecretagency\notifier\web\twig;

use Craft;
use craft\elements\User;
use doublesecretagency\notifier\helpers\Notifier;
use doublesecretagency\notifier\web\twig\tokenparsers\SkipMessageTokenParser;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

/**
 * Class Extension
 * @since 1.0.0
 */
class Extension extends AbstractExtension implements GlobalsInterface
{

    /**
     * @inheritdoc
     */
    public function getGlobals(): array
    {
        // Initialize section info
        $sectionOptions = [];
        $sections = Craft::$app->getSections()->getAllSections();

        // Loop through sections to compile section options
        foreach ($sections as $section) {
            $sectionOptions[$section->id] = $section->name;
        }

        // Return globally accessible variables
        return [
            'notifier' => new Notifier(),
            'notifierUserElementType' => User::class,
            'notifierOptions' => [
                'triggers' => [
                    'event' => [
                        'Entry::EVENT_AFTER_SAVE' => 'When an Entry is saved',
                    ],
                    'sections' => $sectionOptions,
                    'freshness' => [
                        'new' => 'New entries only',
                        'existing' => 'Existing entries only',
                        'both' => 'Both new & existing entries',
                    ],
                    'drafts' => [
                        'published' => 'Published entries only',
                        'drafts' => 'Draft entries only',
                        'both' => 'Both draft & published entries',
                    ],
                ],
                'messages' => [
                    'recipients' => [
                        'type' => [
                            '' => '',
                            'all-users' => 'All users',
                            'all-admins' => 'All admins',
                            'all-users-in-group' => 'All users in selected group(s)',
                            'specific-users' => 'Specific users',
                            'specific-emails' => 'Specific email addresses',
                            'custom' => 'Custom selection',
                        ]
                    ]
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function getTokenParsers(): array
    {
        return [
            new SkipMessageTokenParser(),
        ];
    }

}
