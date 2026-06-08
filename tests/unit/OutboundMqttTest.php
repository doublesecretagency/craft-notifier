<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\models\BaseEnvelope;
use doublesecretagency\notifier\models\OutboundMqtt;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Pure-unit + source-level tests for the OutboundMqtt envelope.
 *
 * The php-mqtt/client socket connection cannot be exercised here (no Craft
 * bootstrap, no live broker), so the connection mechanics are verified at the
 * source level (client construction, TLS / Mutual TLS branches, QoS loop,
 * App::parseEnv on settings, and the bail-and-log guards). The pure-unit half
 * covers property defaults and the isValidTopic() publish-topic validator.
 */
class OutboundMqttTest extends TestCase
{
    private string $mqttSource;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/models/OutboundMqtt.php';
        $this->assertTrue(file_exists($path), "OutboundMqtt.php should exist at: $path");
        $this->mqttSource = file_get_contents($path);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testExtendsBaseEnvelope(): void
    {
        $reflection = new ReflectionClass(OutboundMqtt::class);
        $this->assertTrue($reflection->isSubclassOf(BaseEnvelope::class));
    }

    public function testHasSendMethod(): void
    {
        $reflection = new ReflectionClass(OutboundMqtt::class);
        $this->assertTrue($reflection->hasMethod('send'));
        $this->assertTrue($reflection->getMethod('send')->isPublic());
    }

    // ========================================================================= //
    // Property defaults
    // ========================================================================= //

    public function testDefaultProperties(): void
    {
        $env = new OutboundMqtt();

        $this->assertNull($env->topic);
        $this->assertSame('', $env->payload);
        $this->assertSame(0, $env->qos);
        $this->assertFalse($env->retain);
    }

    public function testConstructorHydratesAllProperties(): void
    {
        $env = new OutboundMqtt([
            'topic'   => 'home/livingroom/lamp',
            'payload' => '{"state":"on"}',
            'qos'     => 2,
            'retain'  => true,
        ]);

        $this->assertSame('home/livingroom/lamp', $env->topic);
        $this->assertSame('{"state":"on"}', $env->payload);
        $this->assertSame(2, $env->qos);
        $this->assertTrue($env->retain);
    }

    // ========================================================================= //
    // Source-level guards
    // ========================================================================= //

    public function testSendUsesPhpMqttClient(): void
    {
        $this->assertStringContainsString('new MqttClient(', $this->mqttSource);
        $this->assertStringContainsString('new ConnectionSettings()', $this->mqttSource);
    }

    public function testSendUsesEnvParseForSettings(): void
    {
        $this->assertStringContainsString('App::parseEnv($settings->mqttHost)', $this->mqttSource);
        $this->assertStringContainsString('App::parseEnv($settings->mqttUsername)', $this->mqttSource);
        $this->assertStringContainsString('App::parseEnv($settings->mqttPassword)', $this->mqttSource);
    }

    public function testSendBailsWhenHostMissing(): void
    {
        $this->assertStringContainsString('if (!$host)', $this->mqttSource);
    }

    public function testSendBailsWhenTopicMissing(): void
    {
        $this->assertStringContainsString('if (!$this->topic)', $this->mqttSource);
    }

    public function testSendBailsWhenPayloadEmpty(): void
    {
        $this->assertStringContainsString("if ('' === trim(\$this->payload))", $this->mqttSource);
    }

    public function testSendResolvesPortByTlsDefault(): void
    {
        // Explicit port wins; otherwise 8883 for TLS, 1883 for plain
        $this->assertMatchesRegularExpression(
            '/\$settings->mqttPort\s*\?:\s*\(\s*\$useTls\s*\?\s*8883\s*:\s*1883\s*\)/',
            $this->mqttSource
        );
    }

    public function testSendConfiguresMutualTlsCertificates(): void
    {
        $this->assertStringContainsString('setTlsCertificateAuthorityFile(', $this->mqttSource);
        $this->assertStringContainsString('setTlsClientCertificateFile(', $this->mqttSource);
        $this->assertStringContainsString('setTlsClientCertificateKeyFile(', $this->mqttSource);
    }

    public function testSendProcessesAckLoopForHigherQos(): void
    {
        // QoS 1/2 must run the loop so the broker acknowledgement is processed
        $this->assertStringContainsString('if ($this->qos > 0)', $this->mqttSource);
        $this->assertStringContainsString('$client->loop(true, true)', $this->mqttSource);
    }

    public function testSendConnectsWithCleanSession(): void
    {
        $this->assertStringContainsString('$client->connect($connectionSettings, true)', $this->mqttSource);
    }

    public function testSendPublishesWithQosAndRetain(): void
    {
        $this->assertStringContainsString('$client->publish($this->topic, $this->payload, $this->qos, $this->retain)', $this->mqttSource);
    }

    public function testSendLogsErrorOnFailureAndReturnsFalse(): void
    {
        $this->assertMatchesRegularExpression(
            '/\$notification->log->error\([^;]*\$this->envelopeId\)/',
            $this->mqttSource
        );
        $this->assertGreaterThanOrEqual(2, substr_count($this->mqttSource, 'return false;'));
    }

    public function testSendLogsSuccessOnSuccess(): void
    {
        $this->assertStringContainsString('$notification->log->success(', $this->mqttSource);
    }

    // ========================================================================= //
    // isValidTopic (pure unit)
    // ========================================================================= //

    /**
     * @return array<string, array{string, bool}>
     */
    public static function topicProvider(): array
    {
        return [
            'plain single-level'   => ['home', true],
            'plain multi-level'    => ['home/livingroom/lamp', true],
            'leading slash'        => ['/devices/sensor', true],
            'single-char'          => ['a', true],
            'plus wildcard'        => ['home/+/lamp', false],
            'hash wildcard'        => ['home/#', false],
            'bare plus'            => ['+', false],
            'bare hash'            => ['#', false],
            'empty string'        => ['', false],
            'whitespace only'      => ['   ', false],
            'null byte'            => ["home/\0/lamp", false],
        ];
    }

    /**
     * @dataProvider topicProvider
     */
    public function testIsValidTopic(string $topic, bool $expected): void
    {
        $this->assertSame($expected, OutboundMqtt::isValidTopic($topic));
    }

    public function testIsValidTopicRejectsNull(): void
    {
        $this->assertFalse(OutboundMqtt::isValidTopic(null));
    }
}
