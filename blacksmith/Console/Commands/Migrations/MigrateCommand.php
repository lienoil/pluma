<?php

namespace Blacksmith\Console\Commands\Migrations;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;

class MigrateCommand extends Command
{
    /**
     * Array of registered commands.
     *
     * @var array
     */
    protected $command = [
        'name' => 'db:migrate',
        'description' => 'Migrate database files',
        'help' => 'Migrate database files',
    ];

    /**
     * Configure the command.
     *
     * @return void
     */
    protected function configure()
    {
        $this->setName($this->command['name'])
            ->setDescription($this->command['description'])
            ->setHelp($this->command['help']);

        $this->addArgument(
            'filename',
            InputArgument::REQUIRED,
            'The name of the file to be generated'
        );
    }

    /**
     * Executes the command.
     *
     * @param  InputInterface  $input
     * @param  OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');

        $name = date("YmdHis_").str_slug($input->getArgument('filename'), '_').".php";
        $output->writeln("<info>Generated file name: $name</info>");

        $classname = studly_case($input->getArgument('filename'));

        $question = new ChoiceQuestion(
            'Select a module?',
            ['Quest', 'Item', 'Frontier']
        );

        $module = $helper->ask($input, $output, $question);

        $output->writeln([
            "",
            "Module selected: <info>$module</info>",
            ""
        ]);
    }
}
