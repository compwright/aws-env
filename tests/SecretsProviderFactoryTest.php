<?php

namespace Compwright\AwsEnv;

class SecretsProviderFactoryTest extends \PHPUnit\Framework\TestCase
{
    public function testNew(): void
    {
        $configResolver = $this->createMock(ConfigurationResolver::class);
        $configResolver->expects($this->once())
            ->method('resolve')
            ->with($this->identicalTo('region'))
            ->will($this->returnValue('us-east-1'));

        $this->assertInstanceOf(
            SecretsProvider::class,
            (new SecretsProviderFactory($configResolver))->new()
        );
    }
}
