<?php
namespace Webjump\HelloWorld\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class Sayhello extends Command
{
    const NAME = 'name';

    protected function configure()
    {
        $options = [
            new InputOption(
                self::NAME,
                null,
                InputOption::VALUE_REQUIRED,
                'Name'
            )
        ];
       $this->setName('example:sayhello');
       $this->setDescription('Demo command line');
       $this->setDefinition($options);

       parent::configure();
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($name = $input->getOption(self::NAME)){

            $output->writeln("Hello " . $name);

        } else {
            $output->writeln("Hello World");
        }
       return $this;
    }
}
