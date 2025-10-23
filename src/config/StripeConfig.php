<?php

namespace App\Config;

class StripeConfig extends BaseConfig
{
    public readonly string $api_key;
    public readonly string $endpoint;
    public readonly int $timeout;

    protected string $serviceName = 'Stripe';

    protected array $requiredParams = [
        'api_key' => 'string',
        'endpoint' => 'string',
    ];
    
    protected array $optionalParams = [
        'timeout' => ['type' => 'int', 'default' => 30],
    ];
}
