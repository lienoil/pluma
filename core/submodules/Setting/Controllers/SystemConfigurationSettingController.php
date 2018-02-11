<?php

namespace Setting\Controllers;

use Illuminate\Http\Request;
use Pluma\Support\Facades\Console;
use Setting\Controllers\SettingController;
use Setting\Models\Setting;
use Setting\Requests\SettingRequest;

class SystemConfigurationSettingController extends SettingController
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view("Setting::settings.configuration");
    }

    /**
     * Store cache in a config file.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function cache(Request $request)
    {
        try {
            Console::call('config:cache');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        return back();
    }
}
