<?php

namespace Compwright\AwsEnv;

use Aws\Ssm\SsmClient;

class SecretsProviderFactory
{
    private ConfigurationResolver $configResolver;

    public function __construct(ConfigurationResolver $configResolver)
    {
        $this->configResolver = $configResolver;
    }

    public function new(): SecretsProvider
    {
        return new SecretsProvider(
            new SsmClient([
                'version' => '2014-11-06',
                'region' => $this->configResolver->resolve('region'),
            ])
        );
    }
}
