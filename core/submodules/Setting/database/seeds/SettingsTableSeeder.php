<?php

use Setting\Models\Setting;
use Pluma\Support\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'site_title' => config('APP_NAME', env('APP_NAME')),
            'site_tagline' => config('APP_NAME', env('APP_TAGLINE')),
            'site_email' => config('APP_NAME', env('MAIL_USERNAME')),
            'date_format' => 'F d, Y',
            'time_format' => 'h:i a',
        ];

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => is_array($value) ? serialize($value) : $value]);
        }
    }
}
