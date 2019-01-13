<?php

namespace Blacksmith\Console\Commands\Api;

use Blacksmith\Support\Console\Command;
use Illuminate\Support\Str;

class ApiGenerateCommand extends Command
{
    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'jwt:secret
        {--s|show : Display the key instead of modifying files.}
        {--f|force : Skip confirmation when overwriting an existing key.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set the JWTAuth secret key used to sign the tokens';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $key = Str::random(32);

        if ($this->option('show')) {
            $this->comment($key);

            return;
        }

        if (file_exists($path = $this->envPath()) === false) {
            return $this->displayKey($key);
        }

        if (Str::contains(file_get_contents($path), 'JWT_SECRET') === false) {
            // update existing entry
            file_put_contents($path, PHP_EOL."JWT_SECRET=$key", FILE_APPEND);
        } else {
            if ($this->isConfirmed() === false) {
                $this->comment('Phew... No changes were made to your secret key.');

                return;
            }

            // create new entry
            file_put_contents($path, str_replace(
                'JWT_SECRET='.$this->webApp['config']['jwt.secret'],
                'JWT_SECRET='.$key, file_get_contents($path)
            ));
        }

        $this->displayKey($key);
    }

    /**
     * Display the key.
     *
     * @param  string  $key
     *
     * @return void
     */
    protected function displayKey($key)
    {
        $this->webApp['config']['jwt.secret'] = $key;

        $this->info("jwt-auth secret [$key] set successfully.");
    }

    /**
     * Check if the modification is confirmed.
     *
     * @return bool
     */
    protected function isConfirmed()
    {
        return $this->option('force') ? true : $this->confirm(
            'This will invalidate all existing tokens. Are you sure you want to override the secret key?'
        );
    }

    /**
     * Get the .env file path.
     *
     * @return string
     */
    protected function envPath()
    {
        if (method_exists($this->webApp, 'environmentFilePath')) {
            return $this->webApp->environmentFilePath();
        }

        // check if webApp version Less than 5.4.17
        if (version_compare($this->webApp->version(), '5.4.17', '<')) {
            return $this->webApp->basePath().DIRECTORY_SEPARATOR.'.env';
        }

        return $this->webApp->basePath('.env');
    }
}
