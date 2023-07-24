<?php

namespace Compwright\AwsEnv;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AwsEnv
{
    private SsmClientFactory $ssmClientFactory;

    private FormatterFactory $formatterFactory;

    public function __construct(SsmClientFactory $ssmClientFactory, FormatterFactory $formatterFactory)
    {
        $this->ssmClientFactory = $ssmClientFactory;
        $this->formatterFactory = $formatterFactory;
    }

    public function __invoke(InputInterface $input, OutputInterface $output): int
    {
        $format = $input->getOption('format');
        $path = $input->getOption('path');

        $secretsProvider = new SecretsProvider(
            $this->ssmClientFactory->new()
        );

        $formatter = $this->formatterFactory->new($format);

        $line = '';
        foreach ($secretsProvider($path) as $key => $value) {
            $line .= $formatter->__invoke($key, $value);
        }

        $output->writeln($line);

        return 0;
    }
}
