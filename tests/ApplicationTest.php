<?php declare(strict_types=1);

namespace OneMustCode\CliFramework\Tests;

use OneMustCode\CliFramework\Application;
use PHPUnit\Framework\TestCase;

class ApplicationTest extends TestCase
{
    /** @var Application */
    protected $application;

    protected function setUp(): void
    {
        $this->application = new Application(
            '/cli-framework'
        );
    }

    public function testGetBasePath(): void
    {
        $this->assertEquals('/cli-framework', $this->application->getBasePath());
    }

    public function testGetAppPath(): void
    {
        $this->assertEquals('/cli-framework/app', $this->application->getAppPath());
    }

    public function testGetProvidersPath(): void
    {
        $this->assertEquals('/cli-framework/app/Providers', $this->application->getProvidersPath());
    }

    public function testGetCommandsPath(): void
    {
        $this->assertEquals('/cli-framework/app/Commands', $this->application->getCommandsPath());
    }
}