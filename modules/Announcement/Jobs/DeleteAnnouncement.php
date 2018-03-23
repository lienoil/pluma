<?php

namespace Announcement\Jobs;

use Announcement\Models\Announcement;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Pluma\Support\Console\Command;

class DeleteAnnouncement implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Announcement::where('expired_at', '<=', Carbon::now())->delete();
    }
}
