<?php declare(strict_types=1);

namespace OneMustCode\CliFramework\Services\Config;

interface ConfigServiceInterface
{
    /**
     * @param string $name
     * @param null $default
     * @return mixed
     */
    public function get(string $name, $default = null);
}
