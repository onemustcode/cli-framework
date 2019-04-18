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
    public function get(string $key, $default = null)
    {
        $config = $this->config;

        if (strpos($key, '.') === false) {
            return $config[$key] ?? $default;
        }

        foreach (explode('.', $key) as $segment) {
            if (is_array($config) && array_key_exists($segment, $config)) {
                $config = $config[$segment];
            } else {
                return $default;
            }
        }

        return $config;
    }
}
