<?php declare(strict_types=1);

namespace OneMustCode\CliFramework\Services\Command;

use OneMustCode\CliFramework\Application;

class CommandService implements CommandServiceInterface
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
     * @inheritdoc
     */
    public function register(string $expression, $callable): void
    {
        $this->app->registerCommand($expression, $callable);
    }
}
