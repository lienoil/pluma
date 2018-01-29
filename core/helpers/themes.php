<?php

use Theme\Models\Theme;


if (! function_exists('get_active_theme')) {
    /**
     * Gets the active theme.
     *
     * @return mixed
     */
    function get_active_theme()
    {
        return Theme::theme(settings('active_theme', settings('default_theme', 'default')));
    }
}
