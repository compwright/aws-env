<?php

namespace Compwright\AwsEnv;

use Aws\Ssm\SsmClient;
use RuntimeException;

class SsmClientFactory
{
    public function new(): SsmClient
    {
        if (!getenv('AWS_REGION') && !getenv('AWS_DEFAULT_REGION')) {
            throw new RuntimeException('Missing environment variable: AWS_REGION or AWS_DEFAULT_REGION must be set');
        }

        return new SsmClient([
            'version' => 'latest',
            'region' => getenv('AWS_REGION') ?: getenv('AWS_DEFAULT_REGION'),
        ]);
    }
}
