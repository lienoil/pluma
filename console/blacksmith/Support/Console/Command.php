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
        return parent::run(
            $this->input = $input, $this->output = new OutputStyle($input, $output)
        );
    }

    /**
     * Calculate the elapsed time since `$s`.
     *
     * @param  microtime $s
     * @return string
     */
    protected function time($s)
    {
        $s = microtime(true) - $s;
        $h = floor($s / 3600);
        $s -= $h * 3600;
        $m = floor($s / 60);
        $s -= $m * 60;
        return $h.':'.sprintf('%02d', $m).':'.sprintf('%02d', $s);
    }
}
