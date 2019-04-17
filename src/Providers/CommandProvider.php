<?php declare(strict_types=1);

namespace OneMustCode\CliFramework\Providers;

use OneMustCode\CliFramework\Commands\CreateCommandCommand;
use OneMustCode\CliFramework\Commands\EnvironmentCommand;
use OneMustCode\CliFramework\Services\Command\CommandService;
use OneMustCode\CliFramework\Services\Command\CommandServiceInterface;

class CommandProvider extends AbstractProvider
{
    /**
     * @inheritdoc
     */
    public function load(): void
    {
        $this->app->bind(CommandServiceInterface::class, function () {
            return new CommandService(
                $this->app
            );
        });

        $this->registerDefaultCommands();
    }

    /**
     * Registers the default commands of the application
     */
    private function registerDefaultCommands(): void
    {
        $this->app->registerCommand('environment', EnvironmentCommand::class);
        $this->app->registerCommand('create', CreateCommandCommand::class);
    }
}