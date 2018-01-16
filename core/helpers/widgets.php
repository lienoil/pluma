<?php

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
