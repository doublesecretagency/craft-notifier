<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\exceptions\RequiredFieldEmptyException;
use Exception;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the pre-parse required-field validation
 * in `Dispatch::_requireFieldNotEmpty()`.
 *
 * Three message types have a body that the upstream API rejects when
 * empty: SMS (Twilio), Pushover, and Slack `chat.postMessage`. Each
 * compile method calls the validator before parsing so the operator
 * sees a clean "Body is empty." log line instead of a TypeError from
 * `_parseTwig()` or a raw upstream API error.
 *
 * Everything else stays permissive: empty subject lines, empty
 * announcement / flash bodies, empty Pushover / ntfy titles, and so on
 * all pass through and render as empty.
 */
class DispatchRequiredFieldValidationTest extends TestCase
{
    private string $dispatchSource;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/models/Dispatch.php';
        $this->assertTrue(file_exists($path), "Dispatch.php should exist at: $path");
        $this->dispatchSource = file_get_contents($path);
    }

    // ========================================================================= //
    // Exception class shape
    // ========================================================================= //

    public function testExceptionClassExists(): void
    {
        $this->assertTrue(class_exists(RequiredFieldEmptyException::class));
    }

    public function testExceptionExtendsException(): void
    {
        $reflection = new ReflectionClass(RequiredFieldEmptyException::class);
        $this->assertTrue($reflection->isSubclassOf(Exception::class));
    }

    // ========================================================================= //
    // _requireFieldNotEmpty helper
    // ========================================================================= //

    public function testHelperIsDefinedInDispatch(): void
    {
        $this->assertStringContainsString(
            'private function _requireFieldNotEmpty(string $key, string $label): void',
            $this->dispatchSource
        );
    }

    public function testHelperThrowsRequiredFieldEmptyException(): void
    {
        // Helper must throw the typed exception so _logError can branch cleanly
        $this->assertMatchesRegularExpression(
            '/_requireFieldNotEmpty[\s\S]*?throw new RequiredFieldEmptyException/',
            $this->dispatchSource
        );
    }

    public function testHelperTrimsValueBeforeChecking(): void
    {
        // A field containing only whitespace should be treated as empty
        $this->assertMatchesRegularExpression(
            '/_requireFieldNotEmpty[\s\S]*?trim\(\(string\) \(\$this->notification->messageConfig\[\$key\] \?\? \'\'\)\)/',
            $this->dispatchSource
        );
    }

    public function testHelperMessageQuotesTheLabel(): void
    {
        // Exception message must read "{Label} is empty." so it lands verbatim in the log
        $this->assertStringContainsString(
            '"{$label} is empty."',
            $this->dispatchSource
        );
    }

    // ========================================================================= //
    // Required-field call sites
    // ========================================================================= //

    /**
     * @return string[][]
     */
    public static function requiredFieldCallSiteProvider(): array
    {
        // [messageConfigKey, label, justification snippet]
        return [
            'SMS body'      => ['smsMessage',  'Body'],
            'Pushover body' => ['pushoverBody', 'Body'],
            'Slack body'    => ['slackBody',   'Body'],
        ];
    }

    /**
     * @dataProvider requiredFieldCallSiteProvider
     */
    public function testCompileMethodValidatesRequiredField(string $key, string $label): void
    {
        // Each truly-required field must be validated before _parseTwig runs
        $this->assertMatchesRegularExpression(
            "/_requireFieldNotEmpty\\('{$key}', '{$label}'\\)/",
            $this->dispatchSource
        );
    }

    // ========================================================================= //
    // Permissive fields (no validator call)
    // ========================================================================= //

    /**
     * @return string[][]
     */
    public static function permissiveFieldProvider(): array
    {
        // Fields where the upstream mechanism accepts empty values, so we must
        // NOT pre-validate. Keeping them on the no-validate list prevents a
        // future refactor from accidentally tightening the contract.
        return [
            ['emailSubject'],
            ['emailMessage'],
            ['announcementTitle'],
            ['announcementMessage'],
            ['flashTitle'],
            ['flashDetails'],
            ['pushoverTitle'],
            ['ntfyTitle'],
            ['ntfyBody'],
            ['ntfyClickUrl'],
            ['slackIcon'],
            ['slackEmoji'],
            ['slackUsername'],
            ['blueskyBody'],
        ];
    }

    /**
     * @dataProvider permissiveFieldProvider
     */
    public function testPermissiveFieldIsNotValidated(string $key): void
    {
        $this->assertDoesNotMatchRegularExpression(
            "/_requireFieldNotEmpty\\('{$key}'/",
            $this->dispatchSource
        );
    }

    // ========================================================================= //
    // _parseTwig accepts null
    // ========================================================================= //

    public function testParseTwigAcceptsNullableString(): void
    {
        // Optional fields routinely pass null/missing, so the signature must allow it
        $this->assertStringContainsString(
            'private function _parseTwig(array $config, ?string $text): string',
            $this->dispatchSource
        );
    }

    public function testParseTwigCoercesNullToEmptyString(): void
    {
        // Coercion must happen before extract() so downstream rendering treats null as empty
        $this->assertMatchesRegularExpression(
            '/_parseTwig[\s\S]*?\$text = \(string\) \$text;/',
            $this->dispatchSource
        );
    }

    // ========================================================================= //
    // _logError branch
    // ========================================================================= //

    public function testLogErrorRecognizesRequiredFieldException(): void
    {
        // _logError must branch on the typed exception to log the bare message
        $this->assertMatchesRegularExpression(
            '/is_a\(\$e, RequiredFieldEmptyException::class\)/',
            $this->dispatchSource
        );
    }

    public function testRequiredFieldErrorIsPrefixedWithTwigError(): void
    {
        // The required-field branch shares the [TWIG ERROR] prefix so the operator
        // fixes it in the same place as a regular parse error
        $this->assertMatchesRegularExpression(
            '/RequiredFieldEmptyException[\s\S]*?\$this->notification->log->error\("\[TWIG ERROR\] \{\$e->getMessage\(\)\}", \$envelopeId\)/',
            $this->dispatchSource
        );
    }

    public function testRequiredFieldExceptionIsImported(): void
    {
        $this->assertStringContainsString(
            'use doublesecretagency\notifier\exceptions\RequiredFieldEmptyException;',
            $this->dispatchSource
        );
    }
}
