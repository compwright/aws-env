<?php

namespace Compwright\AwsEnv;

use Aws\Configuration\ConfigurationResolver as AwsConfigurationResolver;

class ConfigurationResolverTest extends \PHPUnit\Framework\TestCase
{
    public function testResolve(): void
    {
        $configFilePath = implode(DIRECTORY_SEPARATOR, [__DIR__, '.aws', 'config']);
        putenv(AwsConfigurationResolver::ENV_CONFIG_FILE . '=' . $configFilePath);

        $configResolver = new ConfigurationResolver();

        // Default profile
        $this->assertEquals('us-east-1', $configResolver->resolve('region'));

        // myapp profile
        putenv('AWS_PROFILE=myapp');
        $this->assertEquals('us-east-2', $configResolver->resolve('region'));
    }
}
