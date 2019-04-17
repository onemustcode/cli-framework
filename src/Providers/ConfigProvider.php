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
        Dotenv::create(
            $this->app->getBasePath()
        )->load();

        $this->app->bind(ConfigServiceInterface::class, function () {
           return new ConfigService(
               require_once $this->app->getAppPath('config.php')
           );
        });
    }
}