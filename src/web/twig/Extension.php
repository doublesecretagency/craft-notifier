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
use craft\elements\User;
use craft\fields\Dropdown;
use craft\fields\Email;
use craft\fields\PlainText;
use craft\fields\RadioButtons;
use craft\fields\Url;
use doublesecretagency\notifier\enums\Options;
use doublesecretagency\notifier\helpers\Compat;
use doublesecretagency\notifier\helpers\Notifier;
use doublesecretagency\notifier\web\twig\tokenparsers\SetRecipientsTokenParser;
use doublesecretagency\notifier\web\twig\tokenparsers\SkipMessageTokenParser;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
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
            new SetRecipientsTokenParser(),
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

        // Configure available events by installed plugins
        $eventTypes = Options::EVENT_TYPE;
        $eventTypeGrouped = Options::EVENT_TYPE_GROUPED;
        $allEvents = Options::ALL_EVENTS;

        // Hide Commerce Order events if Craft Commerce is not installed
        if (!class_exists('craft\\commerce\\elements\\Order')) {
            unset($eventTypes['craft-commerce-orders'], $eventTypeGrouped['craft-commerce-orders'], $allEvents['craft-commerce-orders']);
        }

        // Hide Commerce Product events if Craft Commerce is not installed
        if (!class_exists('craft\\commerce\\elements\\Product')) {
            unset($eventTypes['craft-commerce-products'], $eventTypeGrouped['craft-commerce-products'], $allEvents['craft-commerce-products']);
        }

        // Hide Digital Products events if the plugin is not installed
        if (!class_exists('craft\\digitalproducts\\elements\\Product')) {
            unset(
                $eventTypes['digital-products-products'],
                $eventTypes['digital-products-licenses'],
                $eventTypeGrouped['digital-products-products'],
                $eventTypeGrouped['digital-products-licenses'],
                $allEvents['digital-products-products'],
                $allEvents['digital-products-licenses']
            );
        }

        // Hide Solspace Calendar events if the plugin is not installed
        if (!class_exists('Solspace\\Calendar\\Elements\\Event')) {
            unset($eventTypes['solspace-calendar-events'], $eventTypeGrouped['solspace-calendar-events'], $allEvents['solspace-calendar-events']);
        }

        // Drop optgroup dividers whose children all got removed above
        $eventTypeGrouped = $this->_pruneEmptyOptgroups($eventTypeGrouped);

        // Return globally accessible variables
        return [
            'notifier' => new Notifier(),
            'notificationOptions' => [
                'eventType'        => $eventTypes,
                'eventTypeOptions' => $eventTypeGrouped,
                'allEvents'        => $allEvents,
                'messageType'      => Options::MESSAGE_TYPE,
                'emailField'       => $fieldOptions['email'],
                'smsField'         => $fieldOptions['sms'],
                'flashType'        => Options::FLASH_TYPE,
                'recipientsType'   => Options::RECIPIENTS_TYPE,
            ],
        ];
    }

    /**
     * Drop optgroup dividers from a grouped options array if all their
     * children were unset upstream (e.g. when the source plugin is absent).
     *
     * @param array $options
     * @return array
     */
    private function _pruneEmptyOptgroups(array $options): array
    {
        $result = [];
        $pendingOptgroup = null;
        foreach ($options as $key => $value) {
            // Optgroup divider - hold until we know a child follows
            if (is_int($key) && is_array($value) && isset($value['optgroup'])) {
                $pendingOptgroup = $value;
                continue;
            }
            // Real option - flush the pending optgroup first, then emit
            if ($pendingOptgroup !== null) {
                $result[] = $pendingOptgroup;
                $pendingOptgroup = null;
            }
            $result[$key] = $value;
        }
        return $result;
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
            new TwigFunction('availableSiteGroupsAndSites', [$this, 'availableSiteGroupsAndSites']),
            new TwigFunction('availableSectionAndEntryTypes', [$this, 'availableSectionAndEntryTypes']),
            new TwigFunction('availableVolumes', [$this, 'availableVolumes']),
            new TwigFunction('availableUserGroups', [$this, 'availableUserGroups']),
            new TwigFunction('availableProductTypes', [$this, 'availableProductTypes']),
            new TwigFunction('availableDigitalProductTypes', [$this, 'availableDigitalProductTypes']),
            new TwigFunction('availableCalendars', [$this, 'availableCalendars']),
        ];
    }

    /**
     * Get all available site groups and sites.
     *
     * @return array
     */
    public function availableSiteGroupsAndSites(): array
    {
        // Get sites services
        $s = Craft::$app->getSites();

        // Initialize site groups
        $siteGroups = [];

        // Loop through all site groups
        foreach ($s->getAllGroups() as $group) {

            // Initialize sites
            $sites = [];

            // Loop through all sites in this site group
            foreach ($s->getSitesByGroupId($group->id) as $site) {

                // Add each site
                $sites[$site->id] = $site->name;

            }

            // Add each site group (with its respective sites)
            $siteGroups[$group->id] = [
                'name' => $group->name,
                'sites' => $sites,
            ];

        }

        // Return compiled options
        return $siteGroups;
    }

    /**
     * Get all available sections and entry types.
     *
     * @return array
     */
    public function availableSectionAndEntryTypes(): array
    {
        // Initialize sections
        $sections = [];

        // Get entries services
        // (Craft 5: Craft::$app->getEntries(), Craft 4: Craft::$app->getSections())
        $entriesService = Compat::isCraft5()
            ? Craft::$app->getEntries()
            : Craft::$app->getSections();

        // Loop through all sections
        foreach ($entriesService->getAllSections() as $section) {

            // Initialize entry types
            $entryTypes = [];

            // Loop through all entry types in this section
            foreach ($entriesService->getEntryTypesBySectionId($section->id) as $type) {

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
     * Get all available asset volumes.
     *
     * @return array
     */
    public function availableVolumes(): array
    {
        // Initialize volumes
        $volumes = [];

        // Loop through all volumes
        foreach (Craft::$app->getVolumes()->getAllVolumes() as $volume) {
            // Append each volume
            $volumes[$volume->id] = $volume->name;
        }

        // Return compiled options
        return $volumes;
    }

    /**
     * Get all available user groups.
     *
     * @return array
     */
    public function availableUserGroups(): array
    {
        // Initialize user groups
        $userGroups = [];

        // Loop through all user groups
        foreach (Craft::$app->getUserGroups()->getAllGroups() as $group) {
            // Append each user group
            $userGroups[$group->id] = $group->name;
        }

        // Return compiled options
        return $userGroups;
    }

    /**
     * Get all available Craft Commerce product types.
     *
     * @return array
     */
    public function availableProductTypes(): array
    {
        // Initialize product types
        $productTypes = [];

        // If Craft Commerce is not installed, return empty
        if (!class_exists('craft\\commerce\\Plugin')) {
            return $productTypes;
        }

        // Loop through all product types
        foreach (\craft\commerce\Plugin::getInstance()->getProductTypes()->getAllProductTypes() as $type) {
            // Append each product type
            $productTypes[$type->id] = $type->name;
        }

        // Return compiled options
        return $productTypes;
    }

    /**
     * Get all available Digital Products product types.
     *
     * @return array
     */
    public function availableDigitalProductTypes(): array
    {
        // Initialize product types
        $productTypes = [];

        // If Digital Products is not installed, return empty
        if (!class_exists('craft\\digitalproducts\\Plugin')) {
            return $productTypes;
        }

        // Loop through all digital product types
        foreach (\craft\digitalproducts\Plugin::getInstance()->getProductTypes()->getAllProductTypes() as $type) {
            // Append each product type
            $productTypes[$type->id] = $type->name;
        }

        // Return compiled options
        return $productTypes;
    }

    /**
     * Get all available Solspace Calendars.
     *
     * @return array
     */
    public function availableCalendars(): array
    {
        // Initialize calendars
        $calendars = [];

        // If Solspace Calendar is not installed, return empty
        if (!class_exists('Solspace\\Calendar\\Calendar')) {
            return $calendars;
        }

        // Loop through all calendars
        foreach (\Solspace\Calendar\Calendar::getInstance()->calendars->getAllCalendars() as $calendar) {
            // Append each calendar
            $calendars[$calendar->id] = $calendar->name;
        }

        // Return compiled options
        return $calendars;
    }

}
