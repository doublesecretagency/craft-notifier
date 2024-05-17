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

namespace doublesecretagency\notifier\web\twig;

use Craft;
use doublesecretagency\notifier\helpers\Notifier;
use craft\elements\User;
use doublesecretagency\notifier\enums\Options;
use doublesecretagency\notifier\web\twig\tokenparsers\SkipMessageTokenParser;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use craft\fields\Dropdown;
use craft\fields\PlainText;
use craft\fields\RadioButtons;
use craft\fields\Url;
use craft\fields\Email;
use Twig\TwigFunction;

/**
 * Class Extension
 * @since 1.0.0
 */
class Extension extends AbstractExtension implements GlobalsInterface
{

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
     * Registers global variables.
     *
     * @return array
     */
    public function getGlobals(): array
    {
        // Generate available field options
        $fieldOptions = $this->_fieldOptions();

        // Return globally accessible variables
        return [
            'notifier' => new Notifier(),
            'notificationOptions' => [
                'eventType'      => Options::EVENT_TYPE,
                'allEvents'      => Options::ALL_EVENTS,
                'messageType'    => Options::MESSAGE_TYPE,
                'emailField'     => $fieldOptions['email'],
                'smsField'       => $fieldOptions['sms'],
                'flashType'      => Options::FLASH_TYPE,
                'recipientsType' => Options::RECIPIENTS_TYPE,
            ],
        ];
    }

    /**
     * Generate available field options.
     *
     * @return array[]
     */
    private function _fieldOptions(): array
    {
        // Field types compatible with
        // phone numbers or email addresses
        $compatibleFieldTypes = [
            Dropdown::class,
            Email::class, // Email addresses only
            PlainText::class,
            RadioButtons::class,
            Url::class,
        ];

        // Initialize field options
        $fieldOptions = [
            'email' => [
                // '' => '', // not needed?
                'email' => 'Email [native User field]',
            ],
            'sms' => [
                '' => ''
            ],
        ];

        // Get field layout for Users
        $fieldLayout = Craft::$app->getFields()->getLayoutByType(User::class);

        // Get custom fields in User layout
        $userLayoutFields = $fieldLayout->getCustomFields();

        // Loop through custom User fields
        foreach ($userLayoutFields as $field) {

            // If field is invalid, skip to the next
            if (!$field) {
                continue;
            }

            // If field type is not compatible, skip to the next
            if (!in_array($field::class, $compatibleFieldTypes)) {
                continue;
            }

            // Add to email field options
            $fieldOptions['email'][$field->handle] = $field->name;

            // If explicitly an email field, skip to the next
            if ($field instanceof Email) {
                continue;
            }

            // Add to SMS field options
            $fieldOptions['sms'][$field->handle] = $field->name;

        }

        // Return field options
        return $fieldOptions;
    }

    // ========================================================================= //

    /**
     * @inheritdoc
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('availableSectionAndEntryTypes', [$this, 'availableSectionAndEntryTypes']),
        ];
    }

    /**
     * Get all available sections and entry types.
     *
     * @return array
     */
    public function availableSectionAndEntryTypes(): array
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

}
