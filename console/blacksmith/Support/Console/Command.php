<?php

namespace Blacksmith\Support\Console;

use Exception;
use Illuminate\Console\OutputStyle;
use Pluma\Support\Console\Command as BaseCommand;
use Symfony\Component\Console\Exception\CommandNotFoundException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Command extends BaseCommand
{
    /**
     * Run the console command.
     *
     * @param  \Symfony\Component\Console\Input\InputInterface  $input
     * @param  \Symfony\Component\Console\Output\OutputInterface  $output
     * @return int
     */
    public function run(InputInterface $input, OutputInterface $output)
    {
        try {
            return parent::run(
                $this->input = $input, $this->output = new OutputStyle($input, $output)
            );
        } catch (CommandNotFoundException $e) {
            $this->error("  {$e->getMessage()}  ");
        } catch (Exception $e) {
            $this->error(str_repeat(' ', 4 + strlen($e->getMessage())));
            $this->error("  {$e->getMessage()}  ");
            $this->error(str_repeat(' ', 4 + strlen($e->getMessage())));
            $this->line("Stack Trace:");
            $this->line($e->getTraceAsString());
        }

        return 0;
    }
}
