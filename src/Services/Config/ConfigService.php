<?php declare(strict_types=1);

namespace OneMustCode\CliFramework\Services\Config;

class ConfigService implements ConfigServiceInterface
{
    /** @var array */
    protected $config = [];

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @inheritdoc
     */
    public function get(string $name, $default = null)
    {
        if (isset($this->config[$name]) === false) {
            return $default;
        }

        return $this->config[$name];
    }
}
