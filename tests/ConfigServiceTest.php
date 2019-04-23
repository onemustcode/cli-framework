<?php declare(strict_types=1);

namespace OneMustCode\CliFramework\Tests;

use OneMustCode\CliFramework\Services\Config\ConfigService;
use OneMustCode\CliFramework\Services\Config\ConfigServiceInterface;
use PHPUnit\Framework\TestCase;

class ConfigServiceTest extends TestCase
{
    /** @var ConfigServiceInterface */
    protected $service;

    public function setUp(): void
    {
        $this->service = new ConfigService([
            'single' => 'single-value',
            'nested' => [
                'value' => 'foo',
                'bar' => 'baz',
            ],
        ]);
    }

    public function testGetSingleValue(): void
    {
        $value = $this->service->get('single');
        $this->assertEquals('single-value', $value);
    }

    public function testGetNestedValue(): void
    {
        $value = $this->service->get('nested.value');
        $this->assertEquals('foo', $value);
    }

    public function testGetArrayValues(): void
    {
        $value = $this->service->get('nested');
        $this->assertEquals([
            'value' => 'foo',
            'bar' => 'baz',
        ], $value);
    }

    public function testDefaultWhenKeyDoesNotExists(): void
    {
        $value = $this->service->get('a.key.that.does.not.exists', 'default-value');
        $this->assertEquals('default-value', $value);
    }
}