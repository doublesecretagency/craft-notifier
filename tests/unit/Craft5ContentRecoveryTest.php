<?php
namespace doublesecretagency\notifier\tests\unit;

use PHPUnit\Framework\TestCase;

/**
 * Guards the Craft 5 only content recovery subclass against being autoloaded on Craft 4.
 *
 * Craft5ContentRecovery extends craft\migrations\BaseContentRefactorMigration,
 * which is @since 5.0.0 and simply does not exist in Craft 4. A class
 * declaration autoloads its parent at class-load time, so merely touching
 * this class on a Craft 4 install fatals with:
 *
 *   Error: Class "craft\migrations\BaseContentRefactorMigration" not found
 *
 * That happens before any runtime guard can execute and cannot be caught, so
 * the only safe pattern is: keep the class in its own file, never reference it
 * except behind a positive Craft version check, and let the `use` import stay
 * (an import is only an alias and never triggers autoload).
 *
 * These tests scan the source rather than reflecting on the class, precisely
 * because loading it is the thing being guarded against.
 */
class Craft5ContentRecoveryTest extends TestCase
{
    /**
     * @var string Absolute path to the plugin's src directory.
     */
    private static string $src = '';

    /**
     * @var string Source of the Craft 5 only subclass.
     */
    private static string $subclass = '';

    /**
     * @var string Source of the helper which instantiates it.
     */
    private static string $helper = '';

    public static function setUpBeforeClass(): void
    {
        static::$src = dirname(__DIR__, 2) . '/src';
        static::$subclass = file_get_contents(static::$src . '/migrations/Craft5ContentRecovery.php');
        static::$helper = file_get_contents(static::$src . '/helpers/ContentRecovery.php');
    }

    // ========================================================================= //

    public function testSubclassFileExists(): void
    {
        $this->assertFileExists(static::$src . '/migrations/Craft5ContentRecovery.php');
    }

    /**
     * The filename must not look like a migration, or Craft's migration manager
     * would try to run it. MigrationManager only picks up m<YYMMDD>_<HHMMSS>_*.
     */
    public function testFilenameIsNotMistakenForAMigration(): void
    {
        $this->assertDoesNotMatchRegularExpression(
            '/^m\d{6}_\d{6}_/',
            'Craft5ContentRecovery.php'
        );
    }

    public function testExtendsCraftsContentRefactorMigration(): void
    {
        $this->assertStringContainsString(
            'use craft\migrations\BaseContentRefactorMigration;',
            static::$subclass
        );
        $this->assertMatchesRegularExpression(
            '/class Craft5ContentRecovery extends BaseContentRefactorMigration/',
            static::$subclass
        );
    }

    /**
     * The class is documented as Craft 5 only, so the next reader does not
     * "helpfully" reference it from somewhere unguarded.
     */
    public function testDocblockDeclaresItCraft5Only(): void
    {
        $this->assertStringContainsString('(Craft 5 only)', static::$subclass);
    }

    // ========================================================================= //

    /**
     * Only ContentRecovery may instantiate it, and only after its Craft 4 bail.
     */
    public function testOnlyTheHelperInstantiatesIt(): void
    {
        $offenders = [];

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator(static::$src, \FilesystemIterator::SKIP_DOTS)
        );

        foreach ($iterator as $file) {
            if (!$file->isFile() || $file->getExtension() !== 'php') {
                continue;
            }

            $path = $file->getPathname();

            // Skip the class's own definition
            if (str_ends_with($path, '/migrations/Craft5ContentRecovery.php')) {
                continue;
            }

            // Skip the one helper allowed to instantiate it
            if (str_ends_with($path, '/helpers/ContentRecovery.php')) {
                continue;
            }

            if (str_contains(file_get_contents($path), 'new Craft5ContentRecovery')) {
                $offenders[] = $path;
            }
        }

        $this->assertSame([], $offenders, 'Craft5ContentRecovery may only be instantiated by ContentRecovery.');
    }

    /**
     * The guard is a positive Craft 4 early-return, never a negated isCraft5().
     * A negated check silently starts meaning "Craft 4 or 6" once isCraft5()
     * is re-bounded for Craft 6.
     */
    public function testHelperBailsOnCraft4BeforeInstantiating(): void
    {
        $this->assertMatchesRegularExpression(
            '/if \(Compat::isCraft4\(\)\) \{\s*return;\s*\}/',
            static::$helper
        );

        $bailPos = strpos(static::$helper, 'Compat::isCraft4()');
        $newPos = strpos(static::$helper, 'new Craft5ContentRecovery');

        $this->assertIsInt($bailPos);
        $this->assertIsInt($newPos);
        $this->assertLessThan($newPos, $bailPos, 'The Craft 4 bail must precede the instantiation.');
    }

    public function testNoNegatedCompatChecksAnywhereInSource(): void
    {
        $offenders = [];

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator(static::$src, \FilesystemIterator::SKIP_DOTS)
        );

        foreach ($iterator as $file) {
            if (!$file->isFile() || $file->getExtension() !== 'php') {
                continue;
            }
            if (preg_match('/!\s*Compat::isCraft\d/', file_get_contents($file->getPathname()))) {
                $offenders[] = $file->getPathname();
            }
        }

        $this->assertSame([], $offenders, 'Match the Craft version positively, never with a negation.');
    }

    // ========================================================================= //

    /**
     * dropTable() is overridden so the drop can be withheld in a front-end
     * request while the row deletion still goes ahead.
     */
    public function testDropTableIsGatedByAllowDrop(): void
    {
        $this->assertMatchesRegularExpression(
            '/public function dropTable\(\$table\)\s*\{\s*\/\/[^\n]*\n\s*if \(!\$this->_allowDrop\) \{\s*return;\s*\}/',
            static::$subclass
        );
        $this->assertStringContainsString('parent::dropTable($table);', static::$subclass);
    }

    /**
     * The override must keep Yii's untyped signature, or PHP fatals on a
     * signature mismatch the moment the class loads.
     */
    public function testDropTableOverrideMatchesYiiSignature(): void
    {
        $this->assertStringContainsString('public function dropTable($table)', static::$subclass);
        $this->assertStringNotContainsString('public function dropTable(string $table)', static::$subclass);
    }

    /**
     * recover() hands both decisions in from the caller rather than deciding
     * for itself, so the helper owns the policy and this class stays a shim.
     */
    public function testRecoverAcceptsPreserveAndAllowDrop(): void
    {
        $this->assertMatchesRegularExpression(
            '/public function recover\(\s*array \$ids,\s*\?FieldLayout \$fieldLayout,\s*bool \$preserveOldData,\s*bool \$allowDrop,?\s*\): void/',
            static::$subclass
        );
        $this->assertStringContainsString('$this->preserveOldData = $preserveOldData;', static::$subclass);
        $this->assertStringContainsString('$this->updateElements($ids, $fieldLayout);', static::$subclass);
    }
}
