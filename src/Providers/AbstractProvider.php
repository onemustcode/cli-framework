<?php declare(strict_types=1);

namespace OneMustCode\CliFramework\Providers;

use OneMustCode\CliFramework\Application;

abstract class AbstractProvider implements ProviderInterface
{
    /** @var Application */
    protected $app;

    /**
     * @param Application $app
     */
    public function __construct(
        Application $app
    )
    {
        $this->app = $app;
    }
}