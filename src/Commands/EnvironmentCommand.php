<?php declare(strict_types=1);

namespace OneMustCode\CliFramework\Commands;

use OneMustCode\CliFramework\Services\Config\ConfigServiceInterface;
use Symfony\Component\Console\Output\OutputInterface;

class EnvironmentCommand
{
    /**
     * @param ConfigServiceInterface $configService
     * @param OutputInterface $output
     */
    public function __invoke(ConfigServiceInterface $configService, OutputInterface $output)
    {
        $environment = $configService->get('environment');

        $output->writeln(
            sprintf('Current environment is: %s', $environment)
        );
    }
}