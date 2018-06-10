<?php

namespace Blacksmith\Console\Commands\App;

use Blacksmith\Support\Console\Command;
use Role\Models\Permission;

class AppPermissionsRefreshCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permissions:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Update or create app permissions.";

    /**
     * Array of permissions to de deleted.
     *
     * @var array
     */
    protected $removables;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $details['old_count'] = Permission::all()->count();
        $details['new'] = 0;

        foreach (Permission::seeds() as $permission) {
            $data = Permission::updateOrCreate(['code' => $permission['code']], $permission);
            $this->removables[] = $data->id;

            if ($data->wasRecentlyCreated) {
                $this->info("Creating New Permission: {$permission['code']}");
                $details['new']++;
            } else {
                $this->warn("Updating Permission: {$permission['code']}");
            }
        }

        Permission::whereNotIn('id', $this->removables)->delete();

        $details['new_count'] = Permission::all()->count();

        $this->info("{$this->checkmark()} {$details['new']} new permissions added.");
        $this->info("{$this->checkmark()} {$details['old_count']} permissions were installed before.");
        $this->info("{$this->checkmark()} {$details['new_count']} permissions in total.");
        $this->info("Done.");
    }
}
