<?php

namespace Compwright\AwsEnv\Formatters;

interface FormatterInterface
{
    public function __invoke(string $key, string $value): string;
}
