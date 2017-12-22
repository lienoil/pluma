<?php

namespace Blacksmith\Console\Commands\Furnace;

use Blacksmith\Support\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Role\Models\Role;
use User\Models\User;

class ForgeAccountCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forge:account';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a user account via terminal';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Filesystem $filesystem)
    {
        $role = $this->choice("Role", Role::pluck('name', 'code')->toArray());
        $firstname = $this->ask("First name");
        $lastname = $this->ask("Last name");
        $email = $this->ask("Email");
        $username = $this->ask("User name", $email);
        $password = $this->secret("Password (hidden)");

        $this->info("==================");
        $this->info("REVIEW NEW ACCOUNT");
        $this->info("==================");
        $this->info("Name: $firstname $lastname");
        $this->info("Email: $email");
        $this->info("");
        $this->info("Username: $username");
        $this->info("Password: ". str_repeat("*", strlen($password)));
        $this->info("Role: $role");
        $this->info("");
        $proceed = $this->ask("Proceed to create this account?", 'yes');

        if ($proceed == 'yes') {
            $user = new User();
            $user->firstname = $firstname;
            $user->lastname = $lastname;
            $user->email = $email;
            $user->username = $username;
            $user->password = Hash::make($password);
            $user->save();
            $user->roles()->save(Role::whereCode($role)->first());
        } else {
            $this->error("Cancelled.");
        }
    }

    /**
     * Delete the specified module folder and files.
     *
     * @param  string $path
     * @return boolean
     */
    public function delete($path)
    {
        return File::deleteDirectory($path);
    }
}
