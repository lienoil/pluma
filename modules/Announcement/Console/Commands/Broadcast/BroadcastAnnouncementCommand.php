<?php

namespace Announcement\Console\Commands\Broadcast;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Filesystem\Filesystem;
use Pluma\Support\Console\Command;

class BroadcastAnnouncementCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'broadcast:announcement';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Broadcast due announcements';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->line("Test");
        $date = date('H_i_s');
        file_put_contents(base_path("ztestfile-{$date}.txt"), 'woot');
    }
}
