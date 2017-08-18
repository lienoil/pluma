<?php

namespace Blacksmith\Console\Commands\Furnace;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class ForgeWeaponCommand extends Command
{
    /**
     * Array of registered commands.
     *
     * @var array
     */
    protected $command = [
        'name' => 'forge:weapon',
        'description' => 'Ask the Blacksmith to forge you a weapon',
        'help' => 'This is a test command meant to show you how to write one.',
        'arguments' => [
            'name' => ['name' => 'name', 'options' => InputArgument::OPTIONAL, 'description' => 'The name of the weapon to be forged', 'default' => 'Iron Dagger'],
        ],
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

        foreach ($this->command['arguments'] as $argument) {
            $this->addArgument(
                $argument['name'] ? $argument['name'] : '',
                $argument['options'] ? $argument['options'] : '',
                $argument['description'] ? $argument['description'] : '',
                $argument['default'] ? $argument['default'] : ''
            );
        }
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
        $time = date("H");
        switch ($time) {
            case $time < 12:
                $greet = "Good morning";
                break;
            case $time == 12:
                $greet = "Good noon";
                break;
            case $time > 12 && $time < 18:
                $greet = "Good afternoon";
                break;
            case $time > 12 && $time >= 18:
                $greet = "Good evening";
                break;
            default:
                $greet = "Good day";
                break;
        }

        $output->writeln([
            $greet,
            "                  Welcome to                   ",
            "===============================================",
            "|<error>          The Blacksmith's Furnace           </error>|",
            "===============================================",
            "",
        ]);

        // For dramatic effect.
        sleep(1); // second

        $helper = $this->getHelper('question');
        $question = new Question('What weapon would you want me to forge? (an iron dagger): ', 'Iron Dagger');
        $weapon = $helper->ask($input, $output, $question);

        $output->writeln(["A <info>$weapon</info> it is.", ""]);

        sleep(1);

        $question = new Question('How many? (just one): ', 1);
        $quantity = $helper->ask($input, $output, $question);

        if ($quantity > 10) {
            $output->writeln([
                "That's too many, but alright.",
                ""
            ]);
        }

        sleep(1);

        $baseprice = rand(10, 5000);
        $price =  $baseprice * $quantity;
        $output->writeln([
            "=========================================",
            "That will be <info>$price</info> gold pence.",
            "=========================================",
            "Breadown:",
            "[x] $weapon (<info>$baseprice gp</info>) x $quantity = $price gp",
        ]);
    }
}
