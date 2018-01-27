<?php

namespace Setting\Controllers;

use Illuminate\Http\Request;
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
}
