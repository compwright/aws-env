<?php

namespace Compwright\AwsEnv\Formatters;

class DotenvFormatter implements FormatterInterface
{
    public function __invoke(string $key, string $value): string
    {
        return sprintf("%s=\"%s\"\n", $key, $value);
    }
}
