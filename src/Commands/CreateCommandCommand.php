<?php declare(strict_types=1);

namespace OneMustCode\CliFramework\Commands;

use OneMustCode\CliFramework\Application;
use Symfony\Component\Console\Output\OutputInterface;

class CreateCommandCommand
{
    /** @var Application */
    protected $app;

    /**
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * @param string $name
     * @param string $class
     * @param OutputInterface $output
     */
    public function __invoke(string $name, string $class, OutputInterface $output)
    {
        $this->makeCommandsDirectory();

        if ($this->doesCommandAlreadyExists($class)) {
            $output->writeln(
                sprintf('The command [%s] already exists!', $class)
            );
            return;
        }

        $this->createCommand($class);

        $this->appendCommandToCommandsFile($name, $class);

        $output->writeln(
            sprintf('Command [%s] created!', $name)
        );
    }

    /**
     * @param string $name
     * @param string $class
     */
    private function appendCommandToCommandsFile(string $name, string $class): void
    {
        $commandsFile = $this->app->getAppPath('commands.php');

        $contents = file_get_contents($commandsFile);

        $command = str_replace([
                '{name}',
                '{class}'
            ], [
                $name,
                $class
            ], '$app->registerCommand(\'{name}\', \App\Commands\{class}::class);');

        file_put_contents($commandsFile, $contents . PHP_EOL . $command);
    }

    /**
     * Create's the command
     *
     * @param string $class
     */
    private function createCommand(string $class): void
    {
        $filePath = $this->app->getCommandsPath(
            $class .'.php'
        );

        $stubContents = file_get_contents(
            __DIR__ . DIRECTORY_SEPARATOR . '..'. DIRECTORY_SEPARATOR .'stubs/command.stub'
        );

        $contents = str_replace([
            '{command}'
        ], [
            $class
        ], $stubContents);

        file_put_contents($filePath, $contents);
    }

    /**
     * Checks if the command already exists
     *
     * @param string $class
     * @return bool
     */
    private function doesCommandAlreadyExists(string $class): bool
    {
        $filePath = $this->app->getCommandsPath(
            $class .'.php'
        );

        return is_file($filePath);
    }

    /**
     * Makes the commands directory if needed
     */
    private function makeCommandsDirectory(): void
    {
        $directory = $this->app->getCommandsPath();

        if (is_dir($directory)) {
            return;
        }

        mkdir(
            $directory, 0755, true
        );
    }
}