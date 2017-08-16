<?php

namespace Quest\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;

class CarryCommand extends Command
{
    /**
     * Array of registered commands.
     *
     * @var array
     */
    protected $command = [
        'name' => 'follower:carry',
        'description' => 'Ask your follower to carry something',
        'help' => 'Ask your follower to carry something.',
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
                'items',
                InputArgument::OPTIONAL,
                'List of items you want your follower to carry'
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
        $items = $input->getArgument('items');
        $helper = $this->getHelper('question');

        $output->writeln([
            '<error>I am sworn to carry your burdens.</error>',
            "",
        ]);
        sleep(1);
        if (empty($items)) {
            $question = new Question('What do you want me to carry? (All) Separate with comma: ', 'All');

            $items = $helper->ask($input, $output, $question);
        }

        yeah_its_a_goto_sue_me:
        $output->writeln("Okay...");
        $items = explode(",", $items);
        sleep(1);
        foreach ($items as $item) {
            $item = trim($item);
            $output->writeln(["[x] $item"]);
            sleep(1);
        }
        $output->writeln("");

        $question = new Question("Anything else? (No, that's it) ", false);

        $items = $helper->ask($input, $output, $question);
        if (! $items) {
            $output->writeln("<error>Let's go then.</error>");
            return;
        }

        goto yeah_its_a_goto_sue_me;
    }
}
