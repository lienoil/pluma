<?php

namespace Pluma\Support\Env\Traits;

use Dotenv\Dotenv;

trait Env
{
    /**
     * Load the env file to the global $_ENV
     *
     * @throws \Dotenv\Exception\InvalidPathException
     * @return void
     */
    public function loadEnv()
    {
        try {
            $envFile = '.env';// TODO: put the config in the config() like this -> config("env", "env");
            $dotenv = new Dotenv($this->getRealPath(), $envFile);
            $dotenv->load();
        } catch (\Dotenv\Exception\InvalidPathException $e) {
            /**
             * If the .env file failed to load,
             * execute Order 66!
             * nah... just bring the app to an
             * env creation page.
             */
            $this->launchEnvCreationPage();
        }
    }

    /**
     * Load the env creation page if no
     * env file found
     *
     * @return void
     */
    private function launchEnvCreationPage()
    {
        // register the routes
        require_once __DIR__.'/../routes/env.php';
    }
}
