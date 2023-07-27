<?php

namespace Compwright\AwsEnv;

use InvalidArgumentException;

class FormatterFactoryTest extends \PHPUnit\Framework\TestCase
{
    public function testNewSupported(): void
    {
        $this->assertInstanceOf(
            Formatters\DotenvFormatter::class,
            (new FormatterFactory())->new('dotenv')
        );

        $this->assertInstanceOf(
            Formatters\ExportFormatter::class,
            (new FormatterFactory())->new('export')
        );

        $this->assertInstanceOf(
            Formatters\EnvFormatter::class,
            (new FormatterFactory())->new('env')
        );
    }

    public function testNewUnsupported(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Unsupported formatter: "foo"');
        (new FormatterFactory())->new('foo');
    }
}
