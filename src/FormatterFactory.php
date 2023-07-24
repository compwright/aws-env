<?php

namespace Compwright\AwsEnv;

use InvalidArgumentException;

class FormatterFactory
{
    public function new(string $type): Formatters\FormatterInterface
    {
        $method = 'new' . ucfirst($type);

        if (method_exists($this, $method)) {
            return $this->$method();
        }

        throw new InvalidArgumentException(sprintf(
            'Unsupported formatter: "%s"',
            $type
        ));
    }

    public function newDotenv(): Formatters\DotenvFormatter
    {
        return new Formatters\DotenvFormatter();
    }

    public function newExec(): Formatters\ExecFormatter
    {
        return new Formatters\ExecFormatter();
    }

    public function newEnv(): Formatters\EnvFormatter
    {
        return new Formatters\EnvFormatter();
    }
}
