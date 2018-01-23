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
    protected $signature = 'app:permissions:refresh';

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

        foreach (get_permissions() as $permissions) {
            $permissions = require $permissions;

            foreach ($permissions as $code => $permission) {
                $data = Permission::updateOrCreate(['code' => $code], $permission);
                $this->removables[] = $data->id;

                if ($data->wasRecentlyCreated) {
                    $this->info("Creating New Permission: {$code}");
                    $details['new']++;
                } else {
                    $this->warn("Updating Permission: {$code}");
                }
            }
        }

        Permission::whereNotIn('id', $this->removables)->delete();

        $details['new_count'] = Permission::all()->count();

        $this->info("{$details['new']} new permissions added");
        $this->info("{$details['old_count']} permissions were installed before");
        $this->info("{$details['new_count']} permissions are installed now");
        $this->info("Done.");
    }
}
