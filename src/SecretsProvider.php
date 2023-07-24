<?php

namespace Compwright\AwsEnv;

use Aws\Exception\AwsException;
use Aws\Ssm\SsmClient;
use Generator;
use RuntimeException;

class SecretsProvider
{
    private SsmClient $ssm;

    public function __construct(SsmClient $ssm)
    {
        $this->ssm = $ssm;
    }

    public function __invoke(string $path): Generator
    {
        $iterator = $this->ssm->getPaginator(
            'GetParametersByPath',
            [
                'Path' => $path,
                'WithDecryption' => true,
            ]
        );

        try {
            foreach ($iterator as $result) {
                foreach ($result->get('Parameters') as $param) {
                    // Params have names like /namespace/environment/PARAM_NAME
                    $key = array_slice(explode('/', $param['Name']), 3)[0];
                    $value = $param['Value'];
                    yield $key => $value;
                }
            }
        } catch (AwsException $e) {
            throw new RuntimeException(
                $e->getAwsErrorMessage() ?? $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
    }
}
