<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\helpers\events\FormieSubmissionEvents;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the FormieSubmissionEvents helper.
 *
 * Notifier's bridge for Formie's form-submission event. Unlike the element
 * lifecycle helpers (Calendar / Commerce / Asset), this one hooks Formie's
 * Submissions SERVICE event, so `$event->sender` is the service, not the
 * element. The submission is therefore bridged into dispatch via the
 * `object` data key (the same pattern UserEvents uses for User Activated),
 * and there is no beforeSave snapshot because a submission is a create.
 */
class FormieSubmissionEventsTest extends TestCase
{
    private string $helperSource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/helpers/events/FormieSubmissionEvents.php';
        $this->assertTrue(file_exists($path), "FormieSubmissionEvents helper should exist at: $path");
        $this->helperSource = file_get_contents($path);
        $this->reflection = new ReflectionClass(FormieSubmissionEvents::class);
    }

    public function testLivesInHelpersEventsNamespace(): void
    {
        $this->assertSame(
            'doublesecretagency\notifier\helpers\events',
            $this->reflection->getNamespaceName()
        );
    }

    public function testImportsSubmissionElementAndSubmissionEvent(): void
    {
        // The handler references the Submission element (for the guard) and
        // the SubmissionEvent class (as the parameter type). Both are Formie
        // classes and are only loadable when Formie is installed, so the
        // registration in Events.php is class_exists()-guarded.
        $this->assertStringContainsString('use verbb\\formie\\elements\\Submission;', $this->helperSource);
        $this->assertStringContainsString('use verbb\\formie\\events\\SubmissionEvent;', $this->helperSource);
    }

    public function testAfterSubmissionIsPublicStaticVoid(): void
    {
        $this->assertTrue($this->reflection->hasMethod('afterSubmission'));
        $m = $this->reflection->getMethod('afterSubmission');
        $this->assertTrue($m->isPublic());
        $this->assertTrue($m->isStatic());
        $this->assertSame('void', (string) $m->getReturnType());
        $params = $m->getParameters();
        $this->assertCount(1, $params);
        $this->assertSame('event', $params[0]->getName());
    }

    public function testGuardsAgainstNonSubmissionPayload(): void
    {
        // The service event could, in theory, carry a null or non-Submission
        // payload; the handler bails rather than dispatching against it.
        $this->assertStringContainsString(
            '!($submission instanceof Submission)',
            $this->helperSource
        );
    }

    public function testFiltersNotificationsByEventTypeAndEventValue(): void
    {
        $this->assertStringContainsString("'eventType' => 'formie-submissions'", $this->helperSource);
        $this->assertStringContainsString("'event' => 'after-submission'", $this->helperSource);
    }

    public function testBridgesSubmissionViaObjectDataKey(): void
    {
        // Because the sender is the Submissions service (not the element), the
        // submission is passed explicitly as data['object'] so the Dispatch
        // filter, the element condition, and the polymorphic Twig seeding all
        // resolve the element. The form and success flag ride alongside.
        // The form is resolved from the submission (not $event->form, which is
        // absent on Formie 2.0.x and would throw UnknownPropertyException).
        $this->assertStringContainsString("'object'  => \$submission", $this->helperSource);
        $this->assertStringContainsString("'form'    => \$submission->getForm()", $this->helperSource);
        $this->assertStringContainsString("'success' => (bool) \$event->success", $this->helperSource);
    }

    public function testDelegatesToMessagesService(): void
    {
        // The single handler funnels matching notifications into the Messages
        // service, passing the bridged data payload.
        $this->assertStringContainsString(
            'messages->sendAll($notifications, $event, $data)',
            $this->helperSource
        );
    }

    public function testHasNoBeforeSaveSnapshot(): void
    {
        // A form submission is a create, so there is no meaningful pre-save
        // original to diff against; the beforeSave / Originals machinery used
        // by the element-lifecycle helpers is intentionally absent here.
        $this->assertFalse($this->reflection->hasMethod('beforeSave'));
        $this->assertStringNotContainsString('Originals::capture', $this->helperSource);
    }
}
