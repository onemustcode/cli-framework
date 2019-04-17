<?php declare(strict_types=1);

namespace OneMustCode\CliFramework\Services\Command;

interface CommandServiceInterface
{
    /**
     * @param string $expression
     * @param $callable
     */
    public function register(string $expression, $callable): void;
}
