<?php

namespace App\Exception;

use RuntimeException;

class MissingConfigException extends RuntimeException
{
    public function __construct(string $serviceName, string $paramName)
    {
        $message = sprintf(
            'Missing configuration parameter "%s" for %s service.',
            $paramName,
            $serviceName
        );

        parent::__construct($message);
    }
}
