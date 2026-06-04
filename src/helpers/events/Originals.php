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

namespace doublesecretagency\notifier\helpers\events;

use craft\base\ElementInterface;

/**
 * Stores pre-save element snapshots for comparison after saving.
 *
 * @since 3.0.0
 */
abstract class Originals
{

    /**
     * @var ElementInterface[][][] Pre-save snapshots, indexed by [class][id][siteId].
     */
    private static array $_store = [];

    /**
     * Record a pre-save snapshot.
     *
     * @param ElementInterface $original
     * @return void
     */
    public static function capture(ElementInterface $original): void
    {
        // No ID = transient draft we can't key against; nothing to capture
        if (!$original->id) {
            return;
        }
        // Site-keyed so per-site propagation can fetch the right snapshot
        $siteId = ($original->siteId ?? 0);
        static::$_store[$original::class][$original->id][$siteId] = $original;
    }

    /**
     * Look up the snapshot captured for an element being saved.
     *
     * @param ElementInterface $current
     * @return ElementInterface|null
     */
    public static function get(ElementInterface $current): ?ElementInterface
    {
        // No ID = no key to look up
        if (empty($current->id)) {
            return null;
        }
        // Default to site 0 when the element has no site
        $siteId = ($current->siteId ?? 0);
        // Return the snapshot for this element and site, or null
        return (static::$_store[$current::class][$current->id][$siteId] ?? null);
    }

    /**
     * Look up a snapshot by explicit class, ID, and site.
     *
     * Used by Entry handlers that need the snapshot before the post-save element is in scope
     * (the per-site after-save fires with the canonical element, keyed by the pre-save siteId).
     *
     * @param class-string<ElementInterface> $class
     * @param int $id
     * @param int|null $siteId
     * @return ElementInterface|null
     */
    public static function find(string $class, int $id, ?int $siteId = null): ?ElementInterface
    {
        // Default to site 0 when no site is given
        $siteId ??= 0;
        // Return the snapshot for this class, ID, and site, or null
        return (static::$_store[$class][$id][$siteId] ?? null);
    }

    /**
     * Reset the registry.
     *
     * Intended for tests; not called in production code.
     *
     * @return void
     */
    public static function reset(): void
    {
        // Clear the registry
        static::$_store = [];
    }

}
