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

namespace doublesecretagency\notifier\helpers;

use Craft;
use craft\elements\User;
use craft\helpers\Json;
use yii\base\ErrorException;

/**
 * Recipients helper
 * @since 1.0.0
 */
class Recipients
{

    /**
     * Get an array of all Users.
     */
    public static function all(): array
    {
        // Log info message
        Log::info("Collecting all system Users as recipients...");

        // Return all active Users
        return User::find()->all();
    }

    /**
     * Get an array of all Admin Users.
     */
    public static function admin(): array
    {
        // Log info message
        Log::info("Collecting all system Admins as recipients...");

        // Return all active admin Users
        return User::find()->admin()->all();
    }

    /**
     * Get an array of Users in selected group(s).
     */
    public static function inGroup(array|string|null $groups): array
    {
        // Log info message
        Log::info("Collecting recipients based on specified user groups...");

        // If no groups, return empty array
        if (!$groups) {
            Log::warning("No user groups were selected.");
            Log::error("Recipients could not be determined, therefore no messages were sent.");
            return [];
        }

        // If all groups selected
        if ('*' === $groups) {
            // Re-initialize as empty array
            $groups = [];
            // Collect ID of every existing user group
            foreach (Craft::$app->getUserGroups()->getAllGroups() as $group) {
                $groups[] = $group->id;
            }
        }

        // If not a valid array of IDs, return empty array
        if (!is_array($groups)) {
            Log::warning("The specified user groups are not valid.");
            Log::error("Recipients could not be determined, therefore no messages were sent.");
            return [];
        }

        // Return all Users in specified group(s)
        return User::find()->groupId($groups)->all();
    }

    // ========================================================================= //

    /**
     * Get an array of email addresses based on a custom snippet.
     */
    public static function custom(array $recipients, array $data): array
    {
        // If no custom recipients specified, log warning and bail
        if (!($recipients['custom'] ?? false)) {
            Log::warning("No custom recipients were specified.");
            return [];
        }

        // Switch according to recipient type
        switch ($recipients['custom']['type'] ?? false) {
            case 'users':
                $snippet = ($recipients['custom']['users'] ?? '');
                return static::_parseUsersSnippet($snippet, $data);
            case 'emails':
                $snippet = ($recipients['custom']['emails'] ?? '');
                return static::_parseEmailsSnippet($snippet, $data);
        }

        // Something went wrong, fallback to empty array
        return [];
    }

    // ========================================================================= //

    /**
     * Use a custom snippet to get a collection of Users' email addresses.
     *
     * @param string $snippet
     * @param array $data
     * @return array
     * @throws ErrorException
     */
    private static function _parseUsersSnippet(string $snippet, array $data): array
    {
        // Log info message
        Log::info("Determining which Users based on custom Twig snippet...");

        // Get view services
        $view = Craft::$app->getView();

        // Parse the custom users snippet
        try {

            // Dynamically generated collection of User IDs
            $results = $view->renderString($snippet, $data);

            // If no IDs, bail
            if (!$results) {
                return [];
            }

            // Get array of User IDs
            $ids = static::_jsonDecode($results);

            // Return all specified Users
            return User::find()
                ->id($ids)
                ->all();

        } catch (Exception $e) {

            // Log an error
            Log::warning("Cannot parse the Twig snippet to determine custom Users. {$e->getMessage()}");
            Log::error("Recipients could not be determined, therefore no emails were sent.");

            // Return an empty array
            return [];
        }
    }

    /**
     * Use a custom snippet to get a collection of email addresses.
     */
    private static function _parseEmailsSnippet(string $snippet, array $data): array
    {
        // Log info message
        Log::info("Determining which email addresses based on custom Twig snippet...");

        // Get view services
        $view = Craft::$app->getView();

        // Parse the custom emails snippet
        try {

            // Dynamically generated collection of email addresses
            $results = $view->renderString($snippet, $data);

            // If no email addresses, bail
            if (!$results) {
                return [];
            }

            // Return array of email addresses
            return static::_jsonDecode($results);

        } catch (Exception $e) {

            // Log an error
            Log::warning("Cannot parse the Twig snippet to determine custom email addresses. {$e->getMessage()}");
            Log::error("Recipients could not be determined, therefore no emails were sent.");

            // Return an empty array
            return [];
        }
    }

    /**
     * JSON decode results, providing a valid fallback.
     *
     * @param string $results
     * @return array
     */
    private static function _jsonDecode(string $results): array
    {
        // Check if JSON is valid
        // Must use this function to validate (I know it's redundant)
        $valid = json_decode($results);

        // Convert config data to an array
        return ($valid ? Json::decode($results) : []);
    }

}
