<?php declare(strict_types=1);

namespace OneMustCode\CliFramework\Commands;

use OneMustCode\CliFramework\Application;
use Symfony\Component\Console\Output\OutputInterface;

class CreateProviderCommand
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
     * @param string $class
     * @param OutputInterface $output
     */
    public function __invoke(string $class, OutputInterface $output)
    {
        $this->makeProvidersDirectory();

        if ($this->doesProviderAlreadyExists($class)) {
            $output->writeln(
                sprintf('The provider [%s] already exists!', $class)
            );
            return;
        }

        $this->createProvider($class);

        $output->writeln(
            sprintf('Provider [%s] is created!', $class)
        );

        $output->writeln('Now copy the line below and paste it in the config.php at the providers section.');

        $output->writeln(
            sprintf('\App\\Providers\\%s::class', $class)
        );
    }

    /**
     * Create's the provider
     *
     * @param string $class
     */
    private function createProvider(string $class): void
    {
        $filePath = $this->app->getProvidersPath(
            $class .'.php'
        );

        $stubContents = file_get_contents(
            __DIR__ . DIRECTORY_SEPARATOR . '..'. DIRECTORY_SEPARATOR .'stubs/provider.stub'
        );

        $contents = str_replace([
            '{provider}'
        ], [
            $class
        ], $stubContents);

        file_put_contents($filePath, $contents);
    }

    /**
     * Checks if the provider already exists
     *
     * @param string $class
     * @return bool
     */
    private function doesProviderAlreadyExists(string $class): bool
    {
        $filePath = $this->app->getProvidersPath(
            $class .'.php'
        );

        return is_file($filePath);
    }

    /**
     * Makes the providers directory if needed
     */
    private function makeProvidersDirectory(): void
    {
        $directory = $this->app->getProvidersPath();

        if (is_dir($directory)) {
            return;
        }

        mkdir(
            $directory, 0755, true
        );
    }
}