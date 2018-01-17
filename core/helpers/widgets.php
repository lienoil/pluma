<?php

use Widget\Models\Widget;

if (! function_exists('get_widgets')) {
    /**
     * Gets all the available widgets.
     *
     * @return array
     */
    function get_widgets()
    {
        $widgets = [];
        foreach (get_modules_path() as $module) {
            if (file_exists("$module/config/widgets.php")) {
                $widget = require_once "$module/config/widgets.php";
                $widgets = array_merge($widgets, ($widget['enabled'] ?? []));
            }
        }

        return json_decode(json_encode($widgets));
    }
}

if (! function_exists('widgets')) {
    /**
     * Get the specified widget.
     *
     * @param  string $code
     * @param  string $column
     * @return  \Illuminate\Database\Eloquent\Model
     */
    function widgets($code = null, $column = "code")
    {
        if (is_null($code)) {
            return get_widgets();
        }

        return Widget::where($column, $code)->first();
    }
}
