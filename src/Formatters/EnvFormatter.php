<?php

namespace Compwright\AwsEnv\Formatters;

class EnvFormatter implements FormatterInterface
{
    public function __invoke(string $key, string $value): string
    {
        return sprintf('%s=%s ', $key, $this->escape($value));
    }

    private function escape(string $string): string
    {
        // https://www.gnu.org/software/coreutils/manual/html_node/env-invocation.html#g_t_002dS_002f_002d_002dsplit_002dstring-syntax
        $replace = [
            "\f" => '\f',
            "\n" => '\n',
            "\r" => '\r',
            "\t" => '\t',
            "\v" => '\v',
            '#' => '\#',
            '$' => '\$',
            ' ' => '\_',
            '"' => '\"',
            "'" => "\'",
            '\\' => '\\\\',
        ];

        return str_replace(
            array_keys($replace),
            array_values($replace),
            $string
        );
    }
}
