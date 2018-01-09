<?php

namespace Blacksmith\Console\Commands\App;

use Blacksmith\Support\Console\Command;

class AppInstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Performs the app installations.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info("Initialiazing...");

        $this->warn("------------------------");
        $this->warn("| Welcome to Pluma CMS |");
        $this->warn("------------------------");
        $this->warn("version " . app()->version());

        // Check env file
        $this->info("Checking .env file...");
        if (! file_exists(base_path('.env'))) {
            copy(base_path('.env.example'), base_path('.env'));
            $this->info("Copied .env.example to .env");
            sleep(1);
            $this->error("App will now shutdown to reset the app's environment variables.");
            $this->error("Run app:install again upon existing.");
            exit();
        } else {
            $this->info("File .env found. Using the file as default.");
        }

        // Generate App Key
        sleep(1);
        $this->info("Checking keys...");
        if (empty(env('APP_KEY'))) {
            $this->call('key:generate');
        } else {
            $this->info("Found existing application key: " . env('APP_KEY'));
        }

        // Write to .env file
        sleep(1);
        $continue = $this->ask("Continue configuring database?", "yes");
        if ($continue === "yes") {
            sleep(1);
            $env['DB']['DB_CONNECTION'] = $this->ask("Database connection", env('DB_CONNECTION'));
            $env['DB']['DB_HOST'] = $this->ask("Database host", env('DB_HOST'));
            $env['DB']['DB_DATABASE'] = $this->ask("Database name", env('DB_DATABASE'));
            $env['DB']['DB_USERNAME'] = $this->ask("Database username", env('DB_USERNAME'));
            $env['DB']['DB_PASSWORD'] = $this->ask("Database password", env('DB_PASSWORD'));
            sleep(1);
            $this->info("Your database info:");
            $this->table(
                ["Connection", "Host", "Database", "Username", "Password"],
                [
                    [
                        $env['DB_CONNECTION'],
                        $env['DB_HOST'],
                        $env['DB_DATABASE'],
                        $env['DB_USERNAME'],
                        str_repeat("*", strlen($env['DB_PASSWORD']))
                    ],
                ]
            );

            if ($this->ask("Write to env file the database configuration?", "yes") === "yes") {
                $this->writeToEnv($env['DB']);
            }
        } else {
            $this->info("Skipped configuring database.");
        }

        // Mail
        sleep(1);
        $continue = $this->ask("Continue configuring mail?", "yes");
        if ($continue === "yes") {
            $env['MAIL']['MAIL_DRIVER'] = $this->ask("Mail driver", env('MAIL_DRIVER'));
            $env['MAIL']['MAIL_HOST'] = $this->ask("Mail host", env('MAIL_HOST'));
            $env['MAIL']['MAIL_PORT'] = $this->ask("Mail port", env('MAIL_PORT'));
            $env['MAIL']['MAIL_USERNAME'] = $this->ask("Mail email", env('MAIL_USERNAME'));
            $env['MAIL']['MAIL_PASSWORD'] = $this->secret("Mail password", env('MAIL_PASSWORD'));
            $env['MAIL']['MAIL_ENCRYPTION'] = $this->ask("Mail encryption", env('MAIL_ENCRYPTION'));
            if ($this->ask("Write to env file the mail configuration?", "yes") === "yes") {
                $this->writeToEnv($env['MAIL']);
            }
        } else {
            $this->info("Skipped configuring mail.");
        }

        // env()
    }

    /**
     * Write values to env file.
     *
     * @param  array $variables
     * @return void
     */
    protected function writeToEnv($variables)
    {
        write_to_env($variables);
    }
}
