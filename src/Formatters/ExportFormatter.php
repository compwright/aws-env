<?php

namespace Compwright\AwsEnv\Formatters;

class ExportFormatter implements FormatterInterface
{
    public function __invoke(string $key, string $value): string
    {
        return sprintf("export %s=\"%s\"\n", $key, $value);
    }
}
