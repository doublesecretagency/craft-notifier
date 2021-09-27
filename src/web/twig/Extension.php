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

namespace doublesecretagency\notifier\web\twig;

use Craft;
use craft\elements\User;
use doublesecretagency\notifier\helpers\Notifier;
use doublesecretagency\notifier\web\assets\NotifierAsset;
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
        // Get block control icons
        $manager = Craft::$app->getAssetManager();
        $iconPath = '@doublesecretagency/notifier/resources/images';

        // Return globally accessible variables
        return [
            'notifier' => new Notifier(),
            'notifierAssets' => NotifierAsset::class,
            'notifierUserElementType' => User::class,
            'notifierOptions' => [
                'triggers' => [
                    'event' => [
                        'Entry::EVENT_AFTER_SAVE' => 'When an Entry is saved',
                    ],
                    'newExisting' => [
                        'both' => 'Both',
                        'new' => 'Newly published entries only',
                        'existing' => 'Updated entries only',
                    ],
                    'sectionsEntryTypes' => $this->_getSectionsAndEntryTypes(),
                ],
                'messages' => [],
                'recipients' => [
                    'type' => [
                        '' => '',
                        'all-users' => 'All users',
                        'all-admins' => 'All admins',
                        'all-users-in-group' => 'All users in selected group(s)',
//                        'specific-users' => 'Specific users',
//                        'specific-emails' => 'Specific email addresses',
                        'custom' => 'Custom selection',
                    ],
                    'userGroups' => $this->_getUserGroups(),
                ]
            ],
            'notifierBlockIcons' => [
                'collapse' => $manager->getPublishedUrl("{$iconPath}/fa-chevron-down-solid.svg", true),
                'edit'     => $manager->getPublishedUrl("{$iconPath}/fa-pencil-alt-solid.svg", true),
                'delete'   => $manager->getPublishedUrl("{$iconPath}/fa-trash-solid.svg", true),
            ],
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

    // ========================================================================= //

    /**
     * Get all sections and entry types.
     *
     * @return array
     */
    private function _getSectionsAndEntryTypes(): array
    {
        // Get sections services
        $s = Craft::$app->getSections();

        // Initialize sections
        $sections = [];

        // Loop through all sections
        foreach ($s->getAllSections() as $section) {

            // Initialize entry types
            $entryTypes = [];

            // Loop through all entry types in this section
            foreach ($s->getEntryTypesBySectionId($section->id) as $type) {

                // Add each entry type
                $entryTypes[$type->id] = $type->name;

            }

            // Add each section (with its respective entry types)
            $sections[$section->id] = [
                'name' => $section->name,
                'entryTypes' => $entryTypes,
            ];

        }

        // Return compiled options
        return $sections;
    }

    /**
     * Get user groups as dropdown field options.
     *
     * @return array
     */
    private function _getUserGroups(): array
    {
        // Initialize user group info
        $options = [];
        $userGroups = Craft::$app->getUserGroups()->getAllGroups();

        // Loop through groups to compile options
        foreach ($userGroups as $group) {
            $options[$group->id] = $group->name;
        }

        // Return compiled options
        return $options;
    }

}
