<?php

namespace App\Tests\Config;

use App\Config\BaseConfig;
use App\Exception\MissingConfigParamException;
use PHPUnit\Framework\TestCase;

class BaseConfigTest extends TestCase
{
    private class TestConfig extends BaseConfig
    {
        public readonly string $foo;
        public readonly int $bar;
        public readonly bool $baz;

        protected string $serviceName = 'TestService';
        protected array $requiredParams = [
            'foo' => 'string',
            'bar' => 'int',
        ];
        protected array $optionalParams = [
            'baz' => ['type' => 'bool', 'default' => true],
        ];
    }

    public function testRequiredParamsAreAssignedAndTyped(): void
    {
        $configArray = [
            'foo' => 'hello',
            'bar' => '123', // should cast to int
        ];

        $config = new self::TestConfig($configArray);

        $this->assertSame('hello', $config->foo);
        $this->assertSame(123, $config->bar);
        $this->assertTrue($config->baz); // default
    }

    public function testMissingRequiredParamThrows(): void
    {
        $this->expectException(MissingConfigParamException::class);
        $this->expectExceptionMessage('TestService');

        new self::TestConfig([
            'bar' => 42,
        ]);
    }

    public function testOptionalParamUsesDefault(): void
    {
        $config = new self::TestConfig([
            'foo' => 'a',
            'bar' => 1,
        ]);

        $this->assertTrue($config->baz);
    }

    public function testOptionalParamOverridesDefault(): void
    {
        $config = new self::TestConfig([
            'foo' => 'a',
            'bar' => 1,
            'baz' => false,
        ]);

        $this->assertFalse($config->baz);
    }
}
