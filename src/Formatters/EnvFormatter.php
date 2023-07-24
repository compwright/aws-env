<?php

namespace Compwright\AwsEnv\Formatters;

class EnvFormatter implements FormatterInterface
{
    public function __invoke(string $key, string $value): string
    {
        return sprintf("%s=\"%s\" ", $key, str_replace(' ', '\_', $value));
    }
}
