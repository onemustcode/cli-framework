<?php declare(strict_types=1);

namespace OneMustCode\CliFramework\Providers;

use Dotenv\Dotenv;
use OneMustCode\CliFramework\Services\Config\ConfigService;
use OneMustCode\CliFramework\Services\Config\ConfigServiceInterface;

class ConfigProvider extends AbstractProvider
{
    /**
     * @inheritdoc
     */
    public function load(): void
    {
        $this->loadDotenv();

        $service = new ConfigService(
            require_once $this->app->getAppPath('config.php')
        );

        $this->app->bind(ConfigServiceInterface::class, $service);
        $this->app->bind('config', $service);
    }

    /**
     * Loads the dotenv if a .env file exists
     */
    private function loadDotenv(): void
    {
        if (file_exists($this->app->getBasePath('.env'))) {
            Dotenv::create(
                $this->app->getBasePath()
            )->load();
        }
    }
}