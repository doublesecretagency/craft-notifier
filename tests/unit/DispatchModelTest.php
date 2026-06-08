<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\base\Model;
use doublesecretagency\notifier\models\Dispatch;
use doublesecretagency\notifier\models\Sandbox;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the Dispatch model.
 *
 * Dispatch is the per-event scratch pad: it owns the active Twig
 * sandbox, the collected dynamic recipients, the compiled envelopes,
 * and the queue/in-process decision. These tests verify its public
 * surface and the source-level guards that govern the pipeline.
 */
class DispatchModelTest extends TestCase
{
    private string $dispatchSource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/models/Dispatch.php';
        $this->assertTrue(file_exists($path), "Dispatch.php should exist at: $path");
        $this->dispatchSource = file_get_contents($path);
        $this->reflection = new ReflectionClass(Dispatch::class);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testExtendsModel(): void
    {
        $this->assertTrue($this->reflection->isSubclassOf(Model::class));
    }

    // ========================================================================= //
    // Public surface
    // ========================================================================= //

    /**
     * @return string[][]
     */
    public static function publicMethodProvider(): array
    {
        return [
            ['filterByEventType'],
            ['configureByMessageType'],
            ['sendEnvelopes'],
            ['parseDynamicRecipientSnippet'],
        ];
    }

    /**
     * @dataProvider publicMethodProvider
     */
    public function testPublicMethodExists(string $method): void
    {
        // The four pipeline stages Messages::send() walks through must each
        // remain publicly callable.
        $this->assertTrue($this->reflection->hasMethod($method));
        $this->assertTrue($this->reflection->getMethod($method)->isPublic());
    }

    // ========================================================================= //
    // Property defaults
    // ========================================================================= //

    public function testUseQueueDefaultsToTrue(): void
    {
        // By default Dispatch routes envelopes through the queue. The
        // four message-type branches override this for flash / announcement.
        $defaults = $this->reflection->getDefaultProperties();
        $this->assertTrue($defaults['useQueue']);
    }

    public function testEnvelopesDefaultsToEmptyArray(): void
    {
        $defaults = $this->reflection->getDefaultProperties();
        $this->assertSame([], $defaults['envelopes']);
    }

    public function testCollectedDynamicRecipientsDefaultsToEmptyArray(): void
    {
        $defaults = $this->reflection->getDefaultProperties();
        $this->assertSame([], $defaults['collectedDynamicRecipients']);
    }

    public function testSetRecipientsInvokedDefaultsToFalse(): void
    {
        // The flag the {% setRecipients %} tag flips on; must default false
        // so a missing tag is detectable.
        $defaults = $this->reflection->getDefaultProperties();
        $this->assertFalse($defaults['setRecipientsInvoked']);
    }

    public function testIsTestDefaultsToFalse(): void
    {
        // Real event-driven dispatches must never log as test rows. The flag
        // is only flipped on by Messages::sendTest().
        $defaults = $this->reflection->getDefaultProperties();
        $this->assertFalse($defaults['isTest']);
    }

    public function testIsTestThreadedIntoEnvelopeLogRows(): void
    {
        // Each compile branch must tag its log->envelope() call with isTest
        // so the log row records the fact. The flag is intentionally NOT
        // passed into the envelope constructor (envelopes are delivery-only).
        // Pin all nine occurrences of the log-side merge (email, sms, announcement,
        // flash, ntfy, slack, pushover, bluesky, mqtt).
        $this->assertSame(
            9,
            preg_match_all(
                "/'isTest'\s*=>\s*\\\$this->isTest/",
                $this->dispatchSource
            )
        );
    }

    // ========================================================================= //
    // Pipeline branches (source-level)
    // ========================================================================= //

    public function testFilterByEventTypeHandlesAllEventTypes(): void
    {
        // The eventType switch must cover entries / users / assets / craft-commerce-orders
        // (the four event-type families Notifier supports).
        $this->assertMatchesRegularExpression(
            "/case\s+'entries'/",
            $this->dispatchSource
        );
        $this->assertMatchesRegularExpression(
            "/case\s+'users'/",
            $this->dispatchSource
        );
        $this->assertMatchesRegularExpression(
            "/case\s+'assets'/",
            $this->dispatchSource
        );
        $this->assertMatchesRegularExpression(
            "/case\s+'craft-commerce-orders'/",
            $this->dispatchSource
        );
    }

    public function testConfigureByMessageTypeHandlesAllChannels(): void
    {
        // Every supported channel must appear as a case in configureByMessageType().
        foreach (['email', 'announcement', 'flash', 'sms', 'pushover', 'ntfy', 'slack', 'bluesky'] as $channel) {
            $this->assertMatchesRegularExpression(
                "/case\s+'{$channel}':/",
                $this->dispatchSource,
                "configureByMessageType() should handle the '{$channel}' channel"
            );
        }
    }

    public function testEmailRespectsEmailQueueConfig(): void
    {
        // emailQueue config defaults to true but must be overridable.
        $this->assertStringContainsString(
            "'emailQueue'",
            $this->dispatchSource
        );
    }

    public function testSmsRespectsSmsQueueConfig(): void
    {
        $this->assertStringContainsString(
            "'smsQueue'",
            $this->dispatchSource
        );
    }

    public function testAnnouncementsAlwaysQueued(): void
    {
        // Announcements have no opt-out, the configureByMessageType branch
        // must hard-set useQueue = true.
        $this->assertMatchesRegularExpression(
            "/case 'announcement':\s*\\\$this->useQueue\s*=\s*true/",
            $this->dispatchSource
        );
    }

    public function testFlashesNeverQueued(): void
    {
        // Flash messages are session-scoped; they must dispatch in-process.
        $this->assertMatchesRegularExpression(
            "/case 'flash':\s*\\\$this->useQueue\s*=\s*false/",
            $this->dispatchSource
        );
    }

    public function testNewChannelsRespectPerMessageQueueConfig(): void
    {
        // Pushover / ntfy / Slack / Bluesky each honor a per-message queue lightswitch.
        $this->assertStringContainsString("'pushoverQueue'", $this->dispatchSource);
        $this->assertStringContainsString("'ntfyQueue'", $this->dispatchSource);
        $this->assertStringContainsString("'slackQueue'", $this->dispatchSource);
        $this->assertStringContainsString("'blueskyQueue'", $this->dispatchSource);
    }

    // ========================================================================= //
    // Slack / ntfy / Pushover / Bluesky compile pipelines
    // ========================================================================= //

    public function testSlackCaseInvokesCompileSlack(): void
    {
        $this->assertMatchesRegularExpression(
            "/case 'slack':[\s\S]*?_compileSlack\(\)/",
            $this->dispatchSource
        );
    }

    public function testNtfyCaseInvokesCompileNtfy(): void
    {
        $this->assertMatchesRegularExpression(
            "/case 'ntfy':[\s\S]*?_compileNtfy\(\)/",
            $this->dispatchSource
        );
    }

    public function testPushoverCaseInvokesCompilePushover(): void
    {
        $this->assertMatchesRegularExpression(
            "/case 'pushover':[\s\S]*?_compilePushover\(\)/",
            $this->dispatchSource
        );
    }

    public function testBlueskyCaseInvokesCompileBluesky(): void
    {
        $this->assertMatchesRegularExpression(
            "/case 'bluesky':[\s\S]*?_compileBluesky\(\)/",
            $this->dispatchSource
        );
    }

    public function testCompileSlackInstantiatesSlackEnvelope(): void
    {
        // _compileSlack() builds OutboundSlack envelopes from the slackBody config.
        $this->assertStringContainsString('new OutboundSlack(', $this->dispatchSource);
        $this->assertStringContainsString("messageConfig['slackBody']", $this->dispatchSource);
    }

    public function testCompileNtfyInstantiatesNtfyEnvelope(): void
    {
        // _compileNtfy() builds OutboundNtfy envelopes and forwards the priority/tags/markdown config.
        $this->assertStringContainsString('new OutboundNtfy(', $this->dispatchSource);
        $this->assertStringContainsString("messageConfig['ntfyBody']", $this->dispatchSource);
        $this->assertStringContainsString("messageConfig['ntfyPriority']", $this->dispatchSource);
    }

    public function testCompilePushoverInstantiatesPushoverEnvelope(): void
    {
        // _compilePushover() builds OutboundPushover envelopes from the per-User key field.
        $this->assertStringContainsString('new OutboundPushover(', $this->dispatchSource);
        $this->assertStringContainsString("messageConfig['pushoverKeyField']", $this->dispatchSource);
        $this->assertStringContainsString("messageConfig['pushoverBody']", $this->dispatchSource);
    }

    public function testCompilePushoverSkipsRecipientsWithoutUserOrKey(): void
    {
        // Three guard branches: no key field configured, recipient has no User, User has no key.
        $this->assertMatchesRegularExpression('/if\s*\(\s*!\$keyFieldHandle\s*\)/', $this->dispatchSource);
        $this->assertMatchesRegularExpression('/if\s*\(\s*!\$recipient->user\s*\)/', $this->dispatchSource);
        $this->assertMatchesRegularExpression('/if\s*\(\s*!\$userKey\s*\)/', $this->dispatchSource);
        $this->assertStringContainsString('[SKIPPED] User "{name}" has no Pushover key.', $this->dispatchSource);
    }

    public function testCompileBlueskyInstantiatesBlueskyEnvelope(): void
    {
        // _compileBluesky() builds OutboundBluesky envelopes and tags the post with the primary site language.
        $this->assertStringContainsString('new OutboundBluesky(', $this->dispatchSource);
        $this->assertStringContainsString("messageConfig['blueskyBody']", $this->dispatchSource);
        $this->assertStringContainsString('getPrimarySite()', $this->dispatchSource);
    }

    public function testCompileBlueskyReadsLinkCardConfig(): void
    {
        // _compileBluesky() forwards the per-notification link-preview toggle, defaulting on.
        $this->assertMatchesRegularExpression(
            "/messageConfig\['blueskyLinkCard'\]\s*\?\?\s*true/",
            $this->dispatchSource
        );
    }

    // ========================================================================= //
    // Announcement compile pipeline
    // ========================================================================= //

    public function testAnnouncementCompilerResolvesRecipientsViaService(): void
    {
        // Announcements now flow through the standard Recipients service
        // (same as email and SMS). The compile region must call getRecipients.
        $this->assertMatchesRegularExpression(
            '/_compileAnnouncement[\s\S]*?recipients->getRecipients\(/',
            $this->dispatchSource
        );
    }

    public function testAnnouncementCompilerPassesCpAccessibleFlag(): void
    {
        // The announcement compile passes cpAccessibleOnly=true so the bulk
        // all-users branch narrows to CP-accessible users at query time.
        $this->assertMatchesRegularExpression(
            '/_compileAnnouncement[\s\S]*?->getRecipients\([^)]*,\s*\$this,\s*true\)/',
            $this->dispatchSource
        );
    }

    public function testAnnouncementCompilerSkipsRecipientsWithoutUser(): void
    {
        // Announcements require a userId; recipients without an associated
        // User must be skipped with a warning rather than crashing.
        $this->assertMatchesRegularExpression(
            '/_compileAnnouncement[\s\S]*?if\s*\(!\$recipient->user\)/',
            $this->dispatchSource
        );
    }

    public function testAnnouncementCompilerSkipsNonCpAccessibleRecipients(): void
    {
        // Front-end-only users wouldn't be able to see the announcement;
        // the compile region must guard with can('accessCp') and skip them.
        $this->assertMatchesRegularExpression(
            "/_compileAnnouncement[\s\S]*?\\\$recipient->user->can\('accessCp'\)/",
            $this->dispatchSource
        );
    }

    public function testAnnouncementCompilerEmitsUserIdInEnvelopeDetails(): void
    {
        // Each emitted envelope must carry the recipient's userId so the
        // OutboundAnnouncement::send() insert has the right target.
        $this->assertMatchesRegularExpression(
            "/_compileAnnouncement[\s\S]*?'userId'\s*=>\s*\\\$recipient->user->id/",
            $this->dispatchSource
        );
    }

    public function testAnnouncementCompilerResolvesPluginIdOnce(): void
    {
        // The plugin id is the same for every recipient in a dispatch, so
        // it's resolved once at the top of _compileAnnouncement() and baked
        // into each envelope. Avoids a per-recipient query at send time.
        // Must use getStoredPluginInfo() (returns the DB row, which carries
        // the `id` column); getPluginInfo() returns Composer + license metadata
        // and has never exposed the row id in Craft 5.
        $this->assertMatchesRegularExpression(
            "/_compileAnnouncement[\s\S]*?getPlugins\(\)->getStoredPluginInfo\('notifier'\)/",
            $this->dispatchSource
        );
        $this->assertDoesNotMatchRegularExpression(
            "/getPlugins\(\)->getPluginInfo\('notifier'\)/",
            $this->dispatchSource,
            'getPluginInfo() does not return the row id; getStoredPluginInfo() must be used.'
        );
        $this->assertMatchesRegularExpression(
            "/_compileAnnouncement[\s\S]*?'pluginId'\s*=>\s*\\\$pluginId/",
            $this->dispatchSource
        );
    }

    // ========================================================================= //
    // Entry-event filtering
    // ========================================================================= //

    public function testEntryFilterChecksSection(): void
    {
        // Section / entry-type / site filters are mandatory short-circuits
        // before the user's filter classes get to run.
        $this->assertStringContainsString('->sectionId', $this->dispatchSource);
    }

    public function testEntryFilterChecksEntryType(): void
    {
        $this->assertStringContainsString('->typeId', $this->dispatchSource);
    }

    public function testEntryFilterChecksSiteOnAfterSave(): void
    {
        // Site filtering only applies to AFTER_SAVE, propagation events
        // produce one save per site, and we want notifications scoped to
        // the user-selected sites.
        $this->assertMatchesRegularExpression(
            "/'after-save'\s*===\s*\\\$this->notification->event/",
            $this->dispatchSource
        );
    }

    public function testEntryFilterRunsConfiguredFilterClasses(): void
    {
        // Filter classes are invoked statically: $filterClass::check($event, $value)
        $this->assertMatchesRegularExpression(
            '/\$filterClass::check\(\$this->event,\s*\$value\)/',
            $this->dispatchSource
        );
    }

    public function testEntryFilterSkipsWhenFilterClassMissing(): void
    {
        // If a referenced filter class no longer exists (e.g. a third-party
        // plugin was uninstalled), the filter should be skipped, not fatal.
        $this->assertStringContainsString(
            'class_exists($filterClass)',
            $this->dispatchSource
        );
    }

    // ========================================================================= //
    // Asset-event filtering
    // ========================================================================= //

    public function testHasFilterAssetsHelper(): void
    {
        // Mandatory volume gate lives in its own private helper, mirroring
        // the structure of _filterEntries / _filterUsers.
        $this->assertTrue($this->reflection->hasMethod('_filterAssets'));
        $this->assertTrue($this->reflection->getMethod('_filterAssets')->isPrivate());
    }

    public function testAssetFilterChecksVolume(): void
    {
        // The volume gate is the single short-circuit for Asset notifications,
        // mirroring how sectionId gates Entry notifications.
        $this->assertStringContainsString('->volumeId', $this->dispatchSource);
    }

    public function testAssetsBranchInvokesAssetsFilterBeforeCondition(): void
    {
        // Asset-specific filters short-circuit first; the heavier condition
        // match only runs once the cheap volume check passes.
        $this->assertMatchesRegularExpression(
            "/case\s+'assets'[\s\S]*?_filterAssets\(\)[\s\S]*?_matchEventCondition\(\)/",
            $this->dispatchSource
        );
    }

    // ========================================================================= //
    // User-event filtering
    // ========================================================================= //

    public function testHasFilterUsersHelper(): void
    {
        // Mandatory user-group gate lives in its own private helper.
        $this->assertTrue($this->reflection->hasMethod('_filterUsers'));
        $this->assertTrue($this->reflection->getMethod('_filterUsers')->isPrivate());
    }

    public function testUserFilterChecksGroups(): void
    {
        // The user-group gate compares the user's actual groups against
        // the configured list. Both calls must appear in the source.
        $this->assertStringContainsString('->getGroups()', $this->dispatchSource);
        $this->assertStringContainsString("'userGroups'", $this->dispatchSource);
    }

    public function testUserFilterHonorsUngroupedSentinel(): void
    {
        // The Ungrouped Users pseudo-row stores a `0` ID. Users with no
        // assigned groups can only match through this sentinel.
        $this->assertMatchesRegularExpression(
            '/in_array\(0,\s*\$userGroups,\s*true\)/',
            $this->dispatchSource
        );
    }

    public function testUserFilterMandatoryGateOnEmptyConfig(): void
    {
        // Zero selected = no users match. Mirror of the entry filter's
        // section gate; an unconfigured user-group list must short-circuit.
        $this->assertMatchesRegularExpression(
            '/empty\(\$userGroups\)[\s\S]*?return\s+false/',
            $this->dispatchSource
        );
    }

    public function testUsersBranchInvokesUsersFilterBeforeCondition(): void
    {
        // User-specific filters short-circuit first; condition match runs after.
        $this->assertMatchesRegularExpression(
            "/case\s+'users'[\s\S]*?_filterUsers\(\)[\s\S]*?_matchEventCondition\(\)/",
            $this->dispatchSource
        );
    }

    // ========================================================================= //
    // Element-condition gate (applies to all event types)
    // ========================================================================= //

    public function testHasMatchEventConditionHelper(): void
    {
        // Centralizing the condition match in one helper lets every event-type
        // branch in filterByEventType() share the same evaluation path.
        $this->assertTrue($this->reflection->hasMethod('_matchEventCondition'));
        $this->assertTrue($this->reflection->getMethod('_matchEventCondition')->isPrivate());
    }

    public function testFilterByEventTypeRunsConditionMatchAfterEventTypeBranches(): void
    {
        // After each event-type branch (entries / users / assets / craft-commerce-orders)
        // resolves, the shared condition gate runs once before returning.
        $this->assertMatchesRegularExpression(
            '/case\s+\'craft-commerce-orders\'[\s\S]*?break;[\s\S]*?_matchEventCondition\(\)/',
            $this->dispatchSource
        );
    }

    public function testEntriesBranchInvokesEntriesFilterBeforeCondition(): void
    {
        // Entries-specific filters (section / entry type / site / FilterInterface
        // classes) must short-circuit first, the heavier condition match only
        // runs once those cheap checks pass.
        $this->assertMatchesRegularExpression(
            "/case\s+'entries'[\s\S]*?_filterEntries\(\)[\s\S]*?_matchEventCondition\(\)/",
            $this->dispatchSource
        );
    }

    public function testMatchEventConditionResolvesElementWithSenderFallback(): void
    {
        // Same precedence as Twig variable seeding: data['object'] takes priority
        // (covers bridged events like User Activated where sender is a service),
        // and event sender is the default fallback for everything else.
        $this->assertMatchesRegularExpression(
            "/_matchEventCondition[\s\S]*?\\\$this->data\\['object'\\]\s*\?\?\s*\\\$this->event->sender/",
            $this->dispatchSource
        );
    }

    public function testMatchEventConditionGuardsOnElementInterface(): void
    {
        // matchElement requires an ElementInterface; the helper must type-guard
        // so a non-element subject doesn't reach the call.
        $this->assertStringContainsString(
            '$element instanceof ElementInterface',
            $this->dispatchSource
        );
    }

    public function testMatchEventConditionShortCircuitsWhenNoConditionConfigured(): void
    {
        // Notifications without a configured condition must dispatch unchanged.
        // The early-return on `!$condition` prevents the helper from forcing
        // an unnecessary instanceof check or matchElement call.
        $this->assertMatchesRegularExpression(
            '/_matchEventCondition[\s\S]*?if\s*\(!\$condition\)\s*\{[\s\S]*?return\s+true/',
            $this->dispatchSource
        );
    }

    public function testMatchEventConditionDelegatesToMatchElement(): void
    {
        // Final return delegates the AND-across-rules evaluation to Craft's
        // ElementCondition::matchElement().
        $this->assertStringContainsString(
            '$condition->matchElement($element)',
            $this->dispatchSource
        );
    }

    public function testImportsElementInterface(): void
    {
        // The instanceof guard above requires the interface to be imported.
        $this->assertStringContainsString(
            'use craft\\base\\ElementInterface',
            $this->dispatchSource
        );
    }

    // ========================================================================= //
    // Sandbox configuration
    // ========================================================================= //

    public function testSandboxBypassWhenDisabled(): void
    {
        // When sandbox config sets mode === DISABLE, Twig is rendered through
        // Craft's default View, not the secure SandboxView.
        $this->assertStringContainsString('Sandbox::DISABLE', $this->dispatchSource);
    }

    public function testSandboxLoadsConfigFromConfigFile(): void
    {
        // Per-project sandbox config lives in config/notifier-sandbox.php.
        $this->assertStringContainsString("'notifier-sandbox'", $this->dispatchSource);
    }

    public function testSandboxFallsBackToBlacklistDefault(): void
    {
        // If no config is supplied, default to blacklist + ADD mode.
        $this->assertStringContainsString('Sandbox::BLACKLIST', $this->dispatchSource);
        $this->assertStringContainsString('Sandbox::ADD', $this->dispatchSource);
    }

    // ========================================================================= //
    // Site-aware rendering
    // ========================================================================= //

    public function testRenderSwitchesToElementSite(): void
    {
        // The per-site trigger fires once per site, but the request's current
        // site stays constant across firings, without an explicit switch,
        // currentSite, entry.url, and other site-aware globals all resolve
        // against the request's site instead of the entry's. _renderObjectTemplate
        // must call setCurrentSite($object->getSite()) when the object is an
        // Element with a siteId.
        $this->assertMatchesRegularExpression(
            '/\$object\s+instanceof\s+Element[\s\S]*?->setCurrentSite\(\$object->getSite\(\)\)/',
            $this->dispatchSource
        );
    }

    public function testRenderRestoresPreviousSiteAfterRender(): void
    {
        // Whatever site the request started on must be restored once the
        // render completes, otherwise the rest of the request (and any
        // subsequent envelope rendered in the same Dispatch) would inherit
        // the swapped site.
        $this->assertMatchesRegularExpression(
            '/finally\s*\{[\s\S]*?->setCurrentSite\(\$previousSite\)/',
            $this->dispatchSource
        );
    }

    public function testRenderResetsTwigGlobalsCacheBeforeEachRender(): void
    {
        // Twig caches resolvedGlobals on first access (Environment.php:898-903).
        // Without resetGlobals(), the second render in the same request reads a
        // stale currentSite from the cache even though setCurrentSite() was
        // called. Both branches (Craft View and SandboxView) must reset.
        $this->assertMatchesRegularExpression(
            '/\$view->getTwig\(\)->resetGlobals\(\)[\s\S]*?\$view->renderObjectTemplate/',
            $this->dispatchSource
        );
        $this->assertMatchesRegularExpression(
            '/\$this->_sandboxView->getTwig\(\)->resetGlobals\(\)[\s\S]*?\$this->_sandboxView->renderObjectTemplate/',
            $this->dispatchSource
        );
    }

    // ========================================================================= //
    // Queue dispatch
    // ========================================================================= //

    public function testSendEnvelopesPushesToQueue(): void
    {
        // sendEnvelopes uses craft\helpers\Queue::push to enqueue
        // SendMessage jobs.
        $this->assertStringContainsString('Queue::push(new SendMessage', $this->dispatchSource);
    }

    public function testSendEnvelopesBypassesQueueWhenInstructed(): void
    {
        // The non-queued path calls $envelope->send() directly.
        $this->assertStringContainsString('$envelope->send()', $this->dispatchSource);
    }

    // ========================================================================= //
    // Twig variable seeding
    // ========================================================================= //

    public function testParseTwigUsesDataObjectWithSenderFallback(): void
    {
        // PR #32 cleanup: every event type seeds `object` from the dispatch's
        // own data array, falling back to the raw event sender. The earlier
        // form special-cased User Activated events with a separate alias,
        // the cleanup pass collapsed both paths into this single line.
        $this->assertStringContainsString(
            "'object' => (\$this->data['object'] ?? \$this->event->sender)",
            $this->dispatchSource
        );
    }

    public function testNoLegacyUniqueCaseCommentForUserActivated(): void
    {
        // The pre-cleanup source carried a "Unique case for User Activated
        // events" comment above the special-case alias. The cleanup removed
        // both the alias and the comment; pinning the comment's absence
        // catches accidental reintroduction of the special case.
        $this->assertStringNotContainsString('Unique case', $this->dispatchSource);
    }

    // ========================================================================= //
    // Tier 2: new event-type filter methods + switch cases
    // ========================================================================= //

    /**
     * @return string[][]
     */
    public static function tier2FilterMethodProvider(): array
    {
        return [
            ['_filterCommerceProducts',        'craft-commerce-products'],
            ['_filterDigitalProducts',         'digital-products-products'],
            ['_filterDigitalProductLicenses',  'digital-products-licenses'],
            ['_filterCalendarEvents',          'solspace-calendar-events'],
        ];
    }

    /**
     * @dataProvider tier2FilterMethodProvider
     */
    public function testTier2FilterMethodExists(string $method): void
    {
        // Each new event-type category gets a private filter method that
        // gates dispatch on the category-specific axis (product type,
        // digital product type, calendar). Mandatory presence; the
        // switch in filterByEventType references each by name.
        $this->assertTrue($this->reflection->hasMethod($method));
        $this->assertTrue($this->reflection->getMethod($method)->isPrivate());
    }

    /**
     * @dataProvider tier2FilterMethodProvider
     */
    public function testFilterByEventTypeRoutesTier2Category(string $method, string $eventType): void
    {
        // The switch in filterByEventType must route each Tier 2 category
        // to its matching private filter method.
        $this->assertMatchesRegularExpression(
            sprintf(
                "/case '%s'[\\s\\S]*?%s\\(\\)/",
                preg_quote($eventType, '/'),
                preg_quote($method, '/')
            ),
            $this->dispatchSource
        );
    }

    public function testCommerceProductsFilterReadsProductTypesConfig(): void
    {
        // Mandatory product-types gate analogous to Sections for entries
        // and Volumes for assets.
        $this->assertStringContainsString(
            "\$this->notification->eventConfig['productTypes']",
            $this->dispatchSource
        );
    }

    public function testDigitalProductsFilterReadsSharedDigitalProductTypesConfig(): void
    {
        // DP Products and DP Licenses share the same filter source under
        // the digitalProductTypes config key.
        $this->assertStringContainsString(
            "\$this->notification->eventConfig['digitalProductTypes']",
            $this->dispatchSource
        );
    }

    public function testDigitalProductLicensesFilterGatesOnParentProductType(): void
    {
        // License filter must gate on the parent product's typeId, not
        // a hypothetical license-level typeId. The body resolves the
        // product via getProduct() then reads its typeId.
        $this->assertMatchesRegularExpression(
            '/_filterDigitalProductLicenses[\s\S]*?getProduct\(\)/',
            $this->dispatchSource
        );
    }

    public function testCalendarEventsFilterReadsCalendarsConfig(): void
    {
        // Mandatory calendars gate analogous to Sections for entries.
        $this->assertStringContainsString(
            "\$this->notification->eventConfig['calendars']",
            $this->dispatchSource
        );
    }

    public function testUserFilterHandlesAssignToGroupsSpecially(): void
    {
        // The assignment event needs newly-assigned-overlap semantics,
        // not the standard "is in any configured group" gate. The branch
        // reads data['newGroupIds'] populated by UserEvents::afterAssignToGroups.
        $this->assertMatchesRegularExpression(
            "/'after-assign-to-groups'[\s\S]*?newGroupIds/",
            $this->dispatchSource
        );
    }
}
