<?php declare(strict_types=1);

namespace OneMustCode\CliFramework\Providers;

use OneMustCode\CliFramework\Commands\CreateCommandCommand;
use OneMustCode\CliFramework\Commands\CreateProviderCommand;
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

        $this->registerCustomCommands();
    }

    /**
     * Registers the default commands of the application
     */
    private function registerDefaultCommands(): void
    {
        $this->app->registerCommand('environment', EnvironmentCommand::class)
            ->setDescription('Returns the application environment');

        $this->app->registerCommand('create:command [name] [class]', CreateCommandCommand::class)
            ->setDescription('Create\'s a new command');

        $this->app->registerCommand('create:provider [class]', CreateProviderCommand::class)
            ->setDescription('Create\'s new provider.');
    }

    /**
     * Registers the custom defined commands
     */
    private function registerCustomCommands(): void
    {
        $app = $this->app;

        require_once $app->getAppPath('commands.php');
    }
}