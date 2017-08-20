<?php

namespace Pluma\Providers;

use Illuminate\Encryption\Encrypter;
use Illuminate\Encryption\EncryptionServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use RuntimeException;

class EncryptionServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('encrypter', function ($app) {
            $config = $app->make('config')->get('encryption');

            // If the key starts with "base64:", we will need to decode the key before handing
            // it off to the encrypter. Keys may be base-64 encoded for presentation and we
            // want to make sure to convert them back to the raw bytes before encrypting.
            if (Str::startsWith($key = $this->key($config), 'base64:')) {
                $key = base64_decode(substr($key, 7));
            }

            return new Encrypter($key, $config['cipher']);
        });
    }

    /**
     * Extract the encryption key from the given configuration.
     *
     * @param  array  $config
     * @return string
     */
    protected function key(array $config)
    {
        return tap($config['key'], function ($key) {
            if (empty($key)) {
                $this->tryResolve($key);
            }
        });
    }

    /**
     * Try to generate an encryption key.
     *
     * @param  mixed $key
     * @return void
     */
    protected function tryResolve($key)
    {
        try {
            if (! File::exists(base_path('.env'))) {
                File::copy(base_path('.env.example'), base_path('.env'));
                write_to_env(['APP_KEY' => generate_random_key()]);
            }
        } catch (\Exception $e) {
            throw new RuntimeException(
                'No application encryption key has been specified.'
            );
        }
    }
}
