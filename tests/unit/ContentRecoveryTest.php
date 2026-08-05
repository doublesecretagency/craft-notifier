<?php
namespace doublesecretagency\notifier\tests\unit;

use PHPUnit\Framework\TestCase;

/**
 * Pins the shape of the Craft 4 to 5 content recovery.
 *
 * Craft's m230511_215903_content_refactor migration moves content out of the
 * `content` table and into `elements_sites`, but it only handles Craft's own
 * element types and exposes no hook for plugins. So every Craft 4 to 5 upgrade
 * strands every notification's title (and, since 3.2.0, every custom field
 * value) in the legacy table.
 *
 * A dated migration cannot fix this: if a user updates Notifier while still on
 * Craft 4, the migration runs, finds nothing, is marked applied permanently,
 * and never fires again once they later upgrade to Craft 5. Hence a lazy,
 * idempotent repair keyed on a self-describing signal: the presence of
 * notification rows in a surviving `content` table IS the "needs recovery"
 * state.
 *
 * These are source-level assertions. The recovery is inseparable from Craft's
 * database and migration machinery, so it cannot be exercised without a Craft
 * bootstrap. What this suite protects is the set of decisions that are easy to
 * undo by accident during unrelated work. The behavior itself is verified by
 * hand against a real upgraded database.
 */
class ContentRecoveryTest extends TestCase
{
    /**
     * @var string Source of the recovery helper.
     */
    private static string $source = '';

    /**
     * @var string Source of the element query which triggers it.
     */
    private static string $query = '';

    public static function setUpBeforeClass(): void
    {
        $src = dirname(__DIR__, 2) . '/src';
        static::$source = file_get_contents($src . '/helpers/ContentRecovery.php');
        static::$query = file_get_contents($src . '/elements/db/NotificationQuery.php');
    }

    // ========================================================================= //

    public function testHelperIsAbstract(): void
    {
        $this->assertStringContainsString('abstract class ContentRecovery', static::$source);
    }

    /**
     * Every read of a notification passes through beforePrepare(), which covers
     * both the CP index and the send path with a single call site. Moving this
     * to the plugin's init() would run it on every front-end request instead.
     */
    public function testTriggeredFromTheElementQuery(): void
    {
        $this->assertStringContainsString(
            'use doublesecretagency\notifier\helpers\ContentRecovery;',
            static::$query
        );
        $this->assertMatchesRegularExpression(
            '/protected function beforePrepare\(\): bool\s*\{[\s\S]*?ContentRecovery::run\(\);/',
            static::$query
        );
    }

    /**
     * A request-level static keeps the check to once per request no matter how
     * many notification queries run.
     */
    public function testRunsAtMostOncePerRequest(): void
    {
        $this->assertStringContainsString('private static bool $_checked = false;', static::$source);
        $this->assertMatchesRegularExpression(
            '/if \(static::\$_checked\) \{\s*return;\s*\}\s*(\/\/[^\n]*\n\s*)?static::\$_checked = true;/',
            static::$source
        );
    }

    /**
     * A repair that throws during an element index render is worse than the
     * blank titles it is fixing.
     */
    public function testNeverLetsAnExceptionEscape(): void
    {
        $this->assertMatchesRegularExpression(
            '/catch \(Throwable \$e\) \{[\s\S]*?Craft::warning\(/',
            static::$source
        );
    }

    public function testTakesAMutexWhileRecovering(): void
    {
        $this->assertStringContainsString("private const LOCK = 'notifier-content-recovery';", static::$source);
        $this->assertStringContainsString('$mutex->acquire(self::LOCK)', static::$source);
        $this->assertStringContainsString('$mutex->release(self::LOCK)', static::$source);
    }

    // ========================================================================= //

    /**
     * updateElements() echoes per-element progress with bare `echo` statements,
     * which are NOT controlled by Yii's $compact flag. Unbuffered, that output lands
     * in the HTTP response body and corrupts any JSON response.
     */
    public function testBuffersTheMigrationsProgressOutput(): void
    {
        $this->assertStringContainsString('ob_start();', static::$source);
        $this->assertStringContainsString('ob_get_clean()', static::$source);

        $bufferPos = strpos(static::$source, 'ob_start();');
        $recoverPos = strpos(static::$source, 'new Craft5ContentRecovery');

        $this->assertLessThan($recoverPos, $bufferPos, 'Buffering must start before the recovery runs.');
    }

    /**
     * A non-null title means someone retyped it after the upgrade. That edit is
     * deliberate and newer than the legacy value, so it wins. The custom field
     * values live in a separate column and must still be recovered.
     */
    public function testPreservesTitlesRetypedAfterTheUpgrade(): void
    {
        $this->assertMatchesRegularExpression(
            '/\$retitled = \(new Query\(\)\)[\s\S]*?andWhere\(\[\'not\', \[\'title\' => null\]\]\)/',
            static::$source
        );

        $readPos = strpos(static::$source, '$retitled = (new Query())');
        $recoverPos = strpos(static::$source, 'new Craft5ContentRecovery');
        $restorePos = strpos(static::$source, 'foreach ($retitled as $id => $title)');

        $this->assertLessThan($recoverPos, $readPos, 'Titles must be read before recovery overwrites them.');
        $this->assertLessThan($restorePos, $recoverPos, 'Titles must be restored after recovery runs.');
    }

    // ========================================================================= //

    /**
     * A column the current layout cannot name is never read, so deleting its
     * row would destroy the values permanently and leave only a log line naming
     * columns. Preserving instead keeps them recoverable by hand.
     */
    public function testPreservesLegacyRowsWhenAColumnCannotBeReached(): void
    {
        $this->assertMatchesRegularExpression(
            '/->recover\(\$ids, \$layout, \(bool\) \$unreachable, \$allowDrop\)/',
            static::$source
        );
    }

    /**
     * The warning names the elements stranded in each column, not every element
     * in the batch, so a support request can go straight to the affected rows.
     */
    public function testWarningNamesTheAffectedElementsPerColumn(): void
    {
        $this->assertStringContainsString(
            '$affected[] = "{$column} (elements: " . implode(\', \', $elementIds) . \')\';',
            static::$source
        );
    }

    /**
     * Craft derives the column from the CURRENT field handle and suffix, so a
     * renamed handle or a recreated field silently misses. Multi-column fields
     * spread across columns sharing both, which is why the suffix is matched at
     * the end rather than the prefix alone.
     */
    public function testDerivesColumnsFromHandleAndSuffix(): void
    {
        $this->assertStringContainsString(
            '$reachable[\'primary\'][] = "field_{$field->handle}{$suffix}";',
            static::$source
        );
        $this->assertStringContainsString(
            '$reachable[\'multi\'][] = ["field_{$field->handle}_", ($suffix ?: \'_\')];',
            static::$source
        );
        $this->assertMatchesRegularExpression(
            '/str_starts_with\(\$column, \$pair\[0\]\) && str_ends_with\(\$column, \$pair\[1\]\)/',
            static::$source
        );
    }

    // ========================================================================= //

    /**
     * Dropping a table during a public front-end request is aggressive, and
     * deferring costs nothing: an empty table is harmless and the next admin
     * request sweeps it. The row deletion is ordinary DML and runs anywhere.
     */
    public function testOnlyDropsTheLegacyTableFromAnAdminContext(): void
    {
        // The drop passed into the recovery, withheld on a front-end request
        $this->assertStringContainsString(
            '$allowDrop = ($request->getIsConsoleRequest() || $request->getIsCpRequest());',
            static::$source
        );

        // The drained-table sweep, and the unrecoverable-state warning
        $this->assertSame(
            2,
            preg_match_all(
                '/if \(!\$request->getIsConsoleRequest\(\) && !\$request->getIsCpRequest\(\)\) \{\s*return;\s*\}/',
                static::$source
            ),
            'The drained-table sweep and the unrecoverable warning must both require an admin.'
        );
    }

    /**
     * Craft drops the table the moment its last row leaves, but only while its
     * own migration runs. Anything recovered afterward leaves the drained table
     * standing forever, because nothing else ever looks at it again.
     */
    public function testSweepsUpADrainedTable(): void
    {
        $this->assertMatchesRegularExpression(
            '/if \(!\$ids\) \{\s*[^\n]*\n\s*static::_dropIfEmpty\(\$db\);/',
            static::$source
        );
        $this->assertStringContainsString('dropTableIfExists(self::CONTENT)', static::$source);
    }

    /**
     * The emptiness check is what makes the drop safe: another plugin's element
     * type with stranded rows of its own keeps the table non-empty, so we can
     * never destroy its recovery data. Verified in the wild against Formie,
     * which has the identical bug.
     */
    public function testNeverDropsATableThatStillHoldsRows(): void
    {
        $this->assertMatchesRegularExpression(
            '/\$rowsExist = \(new Query\(\)\)[\s\S]*?->exists\(\$db\);\s*(\/\/[^\n]*\n\s*)?if \(\$rowsExist\) \{\s*return;\s*\}/',
            static::$source
        );
    }

    // ========================================================================= //

    /**
     * Writing project config from a repair path risks the read-only
     * NotSupportedException, and a throwing migration triggers Craft's
     * restore-on-failure, which has wiped production databases before.
     */
    public function testNeverWritesProjectConfig(): void
    {
        $this->assertStringNotContainsString('savePluginSettings', static::$source);
        $this->assertStringNotContainsString('getProjectConfig()->set', static::$source);
        $this->assertStringNotContainsString('processConfigChanges', static::$source);
    }
}
