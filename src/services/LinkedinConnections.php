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

namespace doublesecretagency\notifier\services;

use Craft;
use craft\base\Component;
use craft\db\Query;
use craft\helpers\App;
use craft\helpers\Db;
use craft\helpers\StringHelper;
use craft\helpers\UrlHelper;
use DateTime;
use DateTimeZone;
use doublesecretagency\notifier\helpers\LinkedinClient;
use doublesecretagency\notifier\models\Settings;
use doublesecretagency\notifier\NotifierPlugin;
use Throwable;

/**
 * Stores and refreshes authorized LinkedIn connections.
 *
 * @since 3.1.0
 */
class LinkedinConnections extends Component
{

    /**
     * @var string The LinkedIn connections table name.
     */
    private const TABLE = '{{%notifier_linkedinconnections}}';

    /**
     * @var int Safety margin: refresh access tokens when fewer than 5 minutes remain.
     */
    private const REFRESH_MARGIN_SECONDS = 300;

    // ========================================================================= //

    /**
     * Get the OAuth redirect URI that LinkedIn returns to.
     *
     * @return string
     */
    public function redirectUri(): string
    {
        // Get the callback action URL
        $url = UrlHelper::actionUrl('notifier/linkedin/callback');

        // Strip the site param to ensure a single canonical callback
        return UrlHelper::removeParam($url, 'site');
    }

    /**
     * Build the LinkedIn authorize URL, or null when the app isn't configured.
     *
     * @param string $state Random CSRF token echoed back to the callback.
     * @return string|null
     */
    public function authorizeUrl(string $state): ?string
    {
        // Get the configured client ID
        $clientId = App::parseEnv($this->_settings()->linkedinClientId);

        // If no client ID is configured, bail
        if (!$clientId) {
            return null;
        }

        // Get the member scopes
        $scopes = LinkedinClient::MEMBER_SCOPES;

        // If enabled, add the organization scope
        if ($this->_settings()->linkedinEnableOrganizations) {
            $scopes[] = LinkedinClient::ORGANIZATION_SCOPE;
        }

        // Return the authorize URL
        return LinkedinClient::authorizeUrl($clientId, $this->redirectUri(), $scopes, $state);
    }

    /**
     * Exchange an authorization code and persist any resulting connections.
     *
     * Always creates a member connection, plus one per administered organization
     * when organization posting is enabled and the app has Community Management approval.
     *
     * @param string $code The authorization code returned to the callback.
     * @param string|null $errorOut By-ref error message slot.
     * @return int The number of connections created, or 0 on failure.
     */
    public function createConnectionsFromCode(string $code, ?string &$errorOut = null): int
    {
        // Get the configured credentials
        $clientId = App::parseEnv($this->_settings()->linkedinClientId);
        $clientSecret = App::parseEnv($this->_settings()->linkedinClientSecret);

        // If the credentials are missing, bail
        if (!$clientId || !$clientSecret) {
            $errorOut = Craft::t('notifier', 'LinkedIn app credentials are not configured.');
            return 0;
        }

        // Exchange the code for a token
        $token = LinkedinClient::exchangeCode($clientId, $clientSecret, $code, $this->redirectUri(), $errorOut);

        // If the exchange failed, bail
        if (!$token) {
            return 0;
        }

        // Get the access token
        $accessToken = $token['access_token'];

        // Get the authenticated member's URN and name
        $member = LinkedinClient::fetchMember($accessToken, $errorOut);

        // If the member couldn't be resolved, bail
        if (!$member) {
            return 0;
        }

        // Track how many connections were created
        $created = 0;

        // Use the member's real name, or a generic fallback label
        $label = ($member['name'] ?: Craft::t('notifier', 'My LinkedIn Profile'));

        // Create (or refresh) the member connection
        $this->_upsertConnection('member', $member['urn'], $label, $token);
        $created++;

        // If organization posting is enabled, create a connection per administered organization
        if ($this->_settings()->linkedinEnableOrganizations) {
            foreach (LinkedinClient::fetchAdministeredOrganizations($accessToken) as $org) {
                $this->_upsertConnection('organization', $org['urn'], $org['name'], $token);
                $created++;
            }
        }

        // Return the number of connections created
        return $created;
    }

    /**
     * Get a fresh, decrypted access token for a connection, refreshing if needed.
     *
     * @param string $uid The connection UID.
     * @param string|null $errorOut By-ref error message slot.
     * @return string|null The decrypted access token, or null if a reconnect is required.
     */
    public function getSendableToken(string $uid, ?string &$errorOut = null): ?string
    {
        // Get the connection row
        $row = $this->getConnection($uid);

        // If the connection no longer exists, bail
        if (!$row) {
            $errorOut = Craft::t('notifier', 'The LinkedIn connection no longer exists.');
            return null;
        }

        // Decrypt the stored access token
        $accessToken = $this->_decrypt($row['accessToken']);

        // Get the access token expiry timestamp
        $expiresAt = $this->_timestamp($row['accessExpiresAt']);

        // If the token is still valid past the refresh margin, use it as-is
        if (null === $expiresAt || $expiresAt > (time() + self::REFRESH_MARGIN_SECONDS)) {
            return $accessToken;
        }

        // The token is near or past expiry, so attempt a refresh
        $refreshed = $this->_refreshConnection($row, $errorOut);

        // If the refresh succeeded, return the new token
        if ($refreshed) {
            return $refreshed;
        }

        // If the access token is still valid (refresh failed but margin not reached), use it
        if (null === $expiresAt || $expiresAt > time()) {
            return $accessToken;
        }

        // The token is expired and could not be refreshed
        $errorOut = ($errorOut ?: Craft::t('notifier', 'The LinkedIn access token has expired. Please reconnect.'));
        return null;
    }

    /**
     * Get every connection decorated for the settings UI (no tokens exposed).
     *
     * @return array
     */
    public function getConnections(): array
    {
        // Get every connection row, tolerating a not-yet-migrated table
        try {
            $rows = (new Query())
                ->from(self::TABLE)
                ->orderBy(['dateCreated' => SORT_ASC])
                ->all();
        } catch (Throwable) {
            return [];
        }

        // Initialize the connections
        $connections = [];

        // Loop through every row
        foreach ($rows as $row) {

            // Get the access expiry timestamp
            $accessExpiresAt = $this->_timestamp($row['accessExpiresAt']);

            // Add the decorated connection
            $connections[] = [
                'uid'            => $row['uid'],
                'label'          => $row['label'],
                'authorType'     => $row['authorType'],
                'authorUrn'      => $row['authorUrn'],
                'expiresAt'      => $accessExpiresAt,
                'hasRefresh'     => !empty($row['refreshToken']),
                'expired'        => (null !== $accessExpiresAt && $accessExpiresAt <= time()),
            ];

        }

        // Return the connections
        return $connections;
    }

    /**
     * Get a compact list of connections for the recipient picker.
     *
     * @return array List of ['uid' => string, 'label' => string].
     */
    public function listForOptions(): array
    {
        // Initialize the options
        $options = [];

        // Loop through every connection
        foreach ($this->getConnections() as $connection) {
            // Add the uid and label
            $options[] = [
                'uid'   => $connection['uid'],
                'label' => $connection['label'],
            ];
        }

        // Return the options
        return $options;
    }

    /**
     * Get a single raw connection row by UID.
     *
     * @param string $uid
     * @return array|null
     */
    public function getConnection(string $uid): ?array
    {
        // Get the connection row
        $row = (new Query())
            ->from(self::TABLE)
            ->where(['uid' => $uid])
            ->one();

        // Return the row, or null if not found
        return ($row ?: null);
    }

    /**
     * Delete a connection by UID.
     *
     * @param string $uid
     * @return bool
     */
    public function deleteConnection(string $uid): bool
    {
        // Delete the connection row
        $affected = Craft::$app->getDb()->createCommand()
            ->delete(self::TABLE, ['uid' => $uid])
            ->execute();

        // Return whether a row was deleted
        return ($affected > 0);
    }

    // ========================================================================= //

    /**
     * Insert a new connection, or update the token on an existing one.
     *
     * @param string $authorType Either 'member' or 'organization'.
     * @param string $authorUrn The author URN.
     * @param string $label A friendly name for the connection.
     * @param array $token The token payload from LinkedIn.
     * @return void
     */
    private function _upsertConnection(string $authorType, string $authorUrn, string $label, array $token): void
    {
        // Build the token columns
        $tokenColumns = $this->_tokenColumns($token);

        // Get the current UTC datetime for timestamps
        $now = Db::prepareDateForDb(new DateTime('now', new DateTimeZone('UTC')));

        // Get the database connection
        $db = Craft::$app->getDb();

        // Whether a connection already exists for this author
        $existing = (new Query())
            ->from(self::TABLE)
            ->where(['authorType' => $authorType, 'authorUrn' => $authorUrn])
            ->one();

        // If a connection already exists, update its token in place
        if ($existing) {
            $db->createCommand()
                ->update(self::TABLE, $tokenColumns + ['label' => $label, 'dateUpdated' => $now], ['id' => $existing['id']])
                ->execute();
            return;
        }

        // Otherwise, insert a fresh connection
        $db->createCommand()
            ->insert(self::TABLE, $tokenColumns + [
                'uid'         => StringHelper::UUID(),
                'label'       => $label,
                'authorType'  => $authorType,
                'authorUrn'   => $authorUrn,
                'dateCreated' => $now,
                'dateUpdated' => $now,
            ])
            ->execute();
    }

    /**
     * Refresh a connection's access token using its stored refresh token.
     *
     * @param array $row The connection row.
     * @param string|null $errorOut By-ref error message slot.
     * @return string|null The new decrypted access token, or null on failure.
     */
    private function _refreshConnection(array $row, ?string &$errorOut = null): ?string
    {
        // If there is no refresh token, a reconnect is required
        if (empty($row['refreshToken'])) {
            $errorOut = Craft::t('notifier', 'The LinkedIn access token has expired. Please reconnect.');
            return null;
        }

        // Get the refresh token expiry timestamp
        $refreshExpiresAt = $this->_timestamp($row['refreshExpiresAt']);

        // If the refresh token itself has expired, a reconnect is required
        if (null !== $refreshExpiresAt && $refreshExpiresAt <= time()) {
            $errorOut = Craft::t('notifier', 'The LinkedIn access token has expired. Please reconnect.');
            return null;
        }

        // Get the configured credentials
        $clientId = App::parseEnv($this->_settings()->linkedinClientId);
        $clientSecret = App::parseEnv($this->_settings()->linkedinClientSecret);

        // If the credentials are missing, bail
        if (!$clientId || !$clientSecret) {
            $errorOut = Craft::t('notifier', 'LinkedIn app credentials are not configured.');
            return null;
        }

        // Exchange the refresh token for a new access token
        $token = LinkedinClient::refresh($clientId, $clientSecret, $this->_decrypt($row['refreshToken']), $errorOut);

        // If the refresh failed, bail
        if (!$token) {
            return null;
        }

        // Persist the new token columns
        Craft::$app->getDb()->createCommand()
            ->update(self::TABLE,
                $this->_tokenColumns($token) + ['dateUpdated' => Db::prepareDateForDb(new DateTime('now', new DateTimeZone('UTC')))],
                ['id' => $row['id']]
            )
            ->execute();

        // Return the new decrypted access token
        return $token['access_token'];
    }

    /**
     * Build the encrypted token columns from a LinkedIn token payload.
     *
     * @param array $token The token payload from LinkedIn.
     * @return array
     */
    private function _tokenColumns(array $token): array
    {
        // Get the current time
        $now = time();

        // Get the access token expiry
        $accessExpiresAt = (isset($token['expires_in'])
            ? Db::prepareDateForDb((new DateTime('now', new DateTimeZone('UTC')))->setTimestamp($now + (int) $token['expires_in']))
            : null);

        // Initialize the columns with the encrypted access token and its expiry
        $columns = [
            'accessToken'     => $this->_encrypt($token['access_token']),
            'accessExpiresAt' => $accessExpiresAt,
        ];

        // If a refresh token is present, encrypt and store it with its expiry
        if (!empty($token['refresh_token'])) {
            $columns['refreshToken'] = $this->_encrypt($token['refresh_token']);
            $columns['refreshExpiresAt'] = (isset($token['refresh_token_expires_in'])
                ? Db::prepareDateForDb((new DateTime('now', new DateTimeZone('UTC')))->setTimestamp($now + (int) $token['refresh_token_expires_in']))
                : null);
        }

        // Return the token columns
        return $columns;
    }

    /**
     * Encrypt a value with Craft's security component.
     *
     * @param string $value
     * @return string
     */
    private function _encrypt(string $value): string
    {
        // Encrypt, then base64-encode so the binary ciphertext is safe for a text column
        return base64_encode(Craft::$app->getSecurity()->encryptByKey($value));
    }

    /**
     * Decrypt a value with Craft's security component.
     *
     * @param string|null $value
     * @return string
     */
    private function _decrypt(?string $value): string
    {
        // If there is nothing to decrypt, return an empty string
        if (!$value) {
            return '';
        }

        // Attempt to decrypt the base64-encoded value
        try {
            return Craft::$app->getSecurity()->decryptByKey(base64_decode($value));
        } catch (Throwable) {
            return '';
        }
    }

    /**
     * Convert a stored UTC datetime string to a unix timestamp.
     *
     * @param string|null $datetime
     * @return int|null
     */
    private function _timestamp(?string $datetime): ?int
    {
        // If there is no datetime, return null
        if (!$datetime) {
            return null;
        }

        // Parse the stored UTC datetime into a timestamp
        try {
            return (new DateTime($datetime, new DateTimeZone('UTC')))->getTimestamp();
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * Get the plugin settings.
     *
     * @return Settings
     */
    private function _settings(): Settings
    {
        /** @var Settings $settings */
        $settings = NotifierPlugin::$plugin->getSettings();
        return $settings;
    }

}
