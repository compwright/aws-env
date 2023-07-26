<?php

namespace Compwright\AwsEnv;

use Aws\Ssm\SsmClient;

class SsmClientFactory
{
    private const SSM_API_VERSION = '2014-11-06';

    private string $region;

    public function __construct(string $region)
    {
        $this->region = $region;
    }

    public function new(): SsmClient
    {
        return new SsmClient([
            'version' => self::SSM_API_VERSION,
            'region' => $this->region,
        ]);
    }
}
