<?php declare(strict_types=1);

namespace OneMustCode\CliFramework\Providers;

interface ProviderInterface
{
    /**
     * Loads the provider
     */
    public function load(): void;
}