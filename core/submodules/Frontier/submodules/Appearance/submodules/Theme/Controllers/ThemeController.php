<?php

namespace Theme\Controllers;

use Illuminate\Http\Request;
use Setting\Controllers\SettingController;
use Theme\Models\Theme;
use Theme\Requests\ThemeRequest;

class ThemeController extends SettingController
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $active = Theme::theme(settings('active_theme', 'default'));
        $resources = Theme::themes(false);

        return view("Theme::settings.themes")->with(compact('resources', 'active'));
    }

    /**
     * Display the preview of a given theme.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string  $theme
     * @return \Illuminate\Http\Response
     */
    public function preview(Request $request, $theme)
    {
        $resource = Theme::theme($theme);

        return view("Theme::themes.preview")->with(compact('resource'));
    }
}
