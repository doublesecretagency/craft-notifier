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
use craft\helpers\FileHelper;
use craft\helpers\Json;
use craft\helpers\StringHelper;
use yii\base\ErrorException;
use yii\base\Exception;

/**
 * Log helper
 * @since 1.0.0
 */
class Log
{

    /**
     * Message levels.
     */
    public const SUCCESS = 'success'; // Green
    public const INFO    = 'info';    // White
    public const WARNING = 'warning'; // Yellow
    public const ERROR   = 'error';   // Red

    // ========================================================================= //

    /**
     * Log a new success message.
     *
     * @param string $message
     * @throws ErrorException
     */
    public static function success(string $message): void
    {
        static::_newMessage($message, static::SUCCESS);
    }

    /**
     * Log a new info message.
     *
     * @param string $message
     * @throws ErrorException
     */
    public static function info(string $message): void
    {
        static::_newMessage($message, static::INFO);
    }

    /**
     * Log a new warning message.
     *
     * @param string $message
     * @throws ErrorException
     */
    public static function warning(string $message): void
    {
        static::_newMessage($message, static::WARNING);
    }

    /**
     * Log a new error message.
     *
     * @param string $message
     * @throws ErrorException
     */
    public static function error(string $message): void
    {
        static::_newMessage($message, static::ERROR);
    }

    // ========================================================================= //

    /**
     * Add a new message to the log file.
     *
     * @param string $message
     * @param string $type
     * @throws ErrorException
     */
    private static function _newMessage(string $message, string $type): void
    {
        // Generate unique key
        $key = StringHelper::randomString(16);

        // Various date formats
        $datestamp = date('Y-m-d H:i:s');
        $timestamp = time();
        $microtime = microtime(true);

        // Compile a message summary
        $summary = "{$datestamp} [{$type}] {$message}";

        // Compile data to be logged
        $data = [
            '*'         => $summary,
            'timestamp' => $timestamp,
            'microtime' => $microtime,
            'type'      => $type,
            'message'   => $message,
            'key'       => $key,
        ];

        // Attempt to log message
        try {
            // JSON encode with trailing line break
            $log = Json::encode($data)."\n";
            // Get log file
            $file = Craft::getAlias('@storage/logs/notifier.log');
            // Write message to specified file
            FileHelper::writeToFile($file, $log, ['append' => true]);
        } catch (Exception $e) {
            // Do nothing
        }
    }

    // ========================================================================= //

    /**
     * Get all notification logs from a text file.
     *
     * @return array
     */
    public static function getAllMessages(): array
    {
        // Initialize log data
        $data = [];

        // Get log file
        $file = Craft::getAlias('@storage/logs/notifier.log');

        // Get the raw log data as an array of JSON strings
        $log = @file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        // If no log exists yet
        if (!$log) {
            // Return an empty array
            return [];
        }

        // JSON decode each log line
        foreach ($log as $line) {
            $data[] = Json::decode($line);
        }

        // Return complete log data
        return $data;
    }

}
