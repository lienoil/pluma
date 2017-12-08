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

        return view("Theme::theme.index")->with(compact('resources', 'active'));
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

        if (view()->exists("{$resource->hintpath}::theme.preview")) {
            return view("{$resource->hintpath}::theme.preview")->with(compact('resource'));
        }

        return view("Theme::theme.preview")->with(compact('resource'));
    }

    /**
     * Uploads a Theme File for processing.
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        echo "<pre>";
            var_dump( $request->all() ); die();
        echo "</pre>";
    }
}
