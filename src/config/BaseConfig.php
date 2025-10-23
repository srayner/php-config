<?php

namespace App\Config;

use App\Exception\MissingConfigException;

abstract class BaseConfig
{
    abstract protected string $serviceName;
    abstract protected array $requiredParams; // key => type
    abstract protected array $optionalParams; // key => ['type'=>..., 'default'=>...]

    public function __construct(array $config)
    {
        $serviceName = $this->serviceName;

        foreach ($this->requiredParams as $key => $type) {
            if (!isset($config[$key])) {
                throw new MissingConfigException($serviceName, $key);
            }
            $this->$key = $this->cast($config[$key], $type);
        }

        foreach ($this->optionalParams as $key => $meta) {
            $value = $config[$key] ?? $meta['default'];
            $this->$key = $this->cast($value, $meta['type']);
        }
    }

    private function cast(mixed $value, string $type): mixed
    {
        return match ($type) {
            'string' => (string)$value,
            'int' => (int)$value,
            'float' => (float)$value,
            'bool' => (bool)$value,
            default => $value,
        };
    }
}
