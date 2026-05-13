<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\models\OutboundSlack;
use PHPUnit\Framework\TestCase;

/**
 * Pure-unit validation for the canonical Slack webhook host.
 *
 * Belt-and-suspenders: same checks also live in OutboundSlackTest; this file
 * exists so future Slack-host-related changes have a single dedicated owner.
 */
class SlackWebhookUrlValidationTest extends TestCase
{
    public function testAcceptsCanonicalHost(): void
    {
        $this->assertTrue(
            OutboundSlack::isValidWebhookUrl('https://hooks.slack.com/services/T1/B1/X1')
        );
    }

    public function testRejectsDifferentHost(): void
    {
        $this->assertFalse(
            OutboundSlack::isValidWebhookUrl('https://hooks.evil.com/services/T1/B1/X1')
        );
    }

    public function testRejectsSlackSubdomainWithoutHooks(): void
    {
        $this->assertFalse(
            OutboundSlack::isValidWebhookUrl('https://slack.com/services/T1/B1/X1')
        );
    }

    public function testRejectsHttpScheme(): void
    {
        $this->assertFalse(
            OutboundSlack::isValidWebhookUrl('http://hooks.slack.com/services/T1/B1/X1')
        );
    }

    public function testRejectsMissingServicesPath(): void
    {
        $this->assertFalse(
            OutboundSlack::isValidWebhookUrl('https://hooks.slack.com/other/T1/B1/X1')
        );
    }

    public function testRejectsEmpty(): void
    {
        $this->assertFalse(OutboundSlack::isValidWebhookUrl(''));
        $this->assertFalse(OutboundSlack::isValidWebhookUrl(null));
    }
}
