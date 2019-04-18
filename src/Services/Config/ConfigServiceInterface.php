<?php declare(strict_types=1);

namespace OneMustCode\CliFramework\Services\Config;

interface ConfigServiceInterface
{
    /**
     * @param string $key
     * @param null $default
     * @return mixed
     */
    public function get(string $key, $default = null);
}
