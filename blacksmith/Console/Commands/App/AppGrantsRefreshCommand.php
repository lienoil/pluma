<?php

namespace Blacksmith\Console\Commands\App;

use Blacksmith\Support\Console\Command;
use Role\Models\Grant;
use Role\Models\Permission;

class AppGrantsRefreshCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:grants:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Update or create app grants.";

    /**
     * Array of grants to de deleted.
     *
     * @var array
     */
    protected $removables;

    /**
     * Array of grants.
     *
     * @var array
     */
    protected $grants;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $details['old_count'] = Grant::all()->count();
        $details['new'] = 0;

        foreach (get_permissions() as $permissions) {
            $permissions = require $permissions;

            foreach ($permissions as $code => $permission) {
                if (! isset($permission['group'])) {
                    $permission['group'] = 'others';
                }

                if (is_array($permission['group'])) {
                    foreach ($permission['group'] as $group) {
                        $this->grants[$group][] = $permission;
                    }
                } else {
                    $this->grants[$permission['group']][] = $permission;
                }
            }
        }

        foreach ($this->grants as $code => $permissions) {
            $data = Grant::updateOrCreate(['code' => $code]);
            $data->name = "Full " . ucfirst(str_plural($code));
            $data->code = $code;
            $data->description = "Collection of $code permissions.";
            $data->save();

            $p = [];
            foreach ($permissions as $permission) {
                $permission = Permission::whereCode($permission['code'])->first();

                if ($permission) {
                    $p[] = $permission->id;
                }
            }
            $data->permissions()->sync($p);

            $this->removables[] = $data->id;

            if ($data->wasRecentlyCreated) {
                $this->info("Creating New Grant: {$code}");
                $details['new']++;
            } else {
                $this->warn("Updating Grant: {$code}");
            }
        }

        Grant::whereNotIn('id', $this->removables)->delete();

        $details['new_count'] = Grant::all()->count();

        $this->info("{$details['new']} new grants added");
        $this->info("{$details['old_count']} grants were installed before");
        $this->info("{$details['new_count']} grants are installed now");
        $this->info("Done.");
    }
}
