<?php declare(strict_types=1);

namespace OneMustCode\CliFramework;

use OneMustCode\CliFramework\Providers\CommandProvider;
use OneMustCode\CliFramework\Providers\ConfigProvider;

class Application
{
    /** @var bool */
    protected $started = false;

    /** @var \Silly\Edition\PhpDi\Application */
    protected $app;

    /** @var string */
    protected $basePath;

    /** @var array */
    protected $defaultProviders = [
        ConfigProvider::class,
        CommandProvider::class,
    ];

    /** @var array */
    protected $customProviders = [];

    /**
     * @param string $basePath
     */
    public function __construct(
        string $basePath
    )
    {
        $this->basePath = $basePath;
        $this->app = new \Silly\Edition\PhpDi\Application();
    }

    /**
     * @param string|null $path
     * @return string
     */
    public function getBasePath(string $path = ''): string
    {
        return $this->basePath . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }

    /**
     * @param string $path
     * @return string
     */
    public function getAppPath(string $path = ''): string
    {
        return $this->getBasePath('app' . ($path ? DIRECTORY_SEPARATOR . $path : $path));
    }

    /**
     * @param string $name
     * @param $value
     */
    public function bind(string $name, $value): void
    {
        $this->app->getContainer()->set($name, $value);
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function get(string $name)
    {
        return $this->app->getContainer()->get($name);
    }

    /**
     * Loads the default application providers
     */
    private function loadDefaultProviders(): void
    {
        foreach ($this->defaultProviders as $provider) {
            $this->loadProvider($provider);
        }
    }

    /**
     * Loads the custom providers
     */
    private function loadCustomProviders(): void
    {
        foreach ($this->customProviders as $provider) {
            $this->loadProvider($provider);
        }
    }

    /**
     * @param string $provider
     */
    public function loadProvider(string $provider): void
    {
        (new $provider($this))->load();
    }

    /**
     * Registers a command
     *
     * @param string $expression
     * @param $callable
     */
    public function registerCommand(string $expression, $callable): void
    {
        $this->app->command($expression, $callable);
    }

    /**
     * Starts the application
     */
    public function start(): void
    {
        if ($this->started === true) {
            return;
        }

        $this->loadDefaultProviders();

        $this->loadCustomProviders();

        $this->app->run();

        $this->started = true;
    }
}