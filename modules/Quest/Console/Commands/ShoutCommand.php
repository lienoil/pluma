<?php

namespace Quest\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;

class ShoutCommand extends Command
{
    /**
     * Array of registered commands.
     *
     * @var array
     */
    protected $command = [
        'name' => 'shout',
        'description' => 'Lets you shout',
        'help' => 'Lets you shout',
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
            ->setHelp($this->command['help'])
            ->addArgument(
                'name',
                InputArgument::OPTIONAL,
                'The name of the shout'
            )
        ;
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
        $name = $input->getArgument('name');
        $helper = $this->getHelper('question');

        if (empty($name)) {
            $question = new ChoiceQuestion(
                'What do you want me to shout?',
                ['Fus Ro Dah', 'Wuld Nah Kest', 'Zul Mey Gut']
            );
            $name = $helper->ask($input, $output, $question);
        }

        // For dramatic effect.
        sleep(1);
        $output->writeln(["ahem..."]);
        sleep(1);
        foreach ([3,2,1] as $i) {
            $output->writeln(["$i..."]);
            sleep(1);
        }

        $output->writeln(strtoupper($name)."!");
    }
}
