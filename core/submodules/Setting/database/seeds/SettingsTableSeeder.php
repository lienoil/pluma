<?php

use Phinx\Seed\AbstractSeed;
use Setting\Models\Setting;

class SettingsTableSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $data = [
            'site_title' => env('APP_NAME'),
            'site_tagline' => env('APP_TAGLINE'),
            'site_email' => env('MAIL_USERNAME'),
            'date_format' => 'F d, Y',
            'time_format' => 'h:i a',
        ];

        foreach ($data as $key => $value) {
            $setting = new Setting();
            $setting->key = $key;
            $setting->value = $value;
            $setting->save();
        }
    }
}
