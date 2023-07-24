<?php

namespace Compwright\AwsEnv\Formatters;

class ExecFormatter implements FormatterInterface
{
    public function __invoke(string $key, string $value): string
    {
        return sprintf("export %s=\"%s\"\n", $key, $value);
    }
}
