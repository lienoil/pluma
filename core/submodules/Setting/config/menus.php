<?php

return [
    /**
     * -------------------------------------------------------------------------
     * Setting
     * -------------------------------------------------------------------------
     *
     */
    'settings' => [
        'name' => 'settings',
        'is_parent' => true,
        'order' => 1000,
        'slug' => url(config('path.admin').'/settings'),
        'always_viewable' => false,
        'icon' => 'settings',
        'labels' => [
            'title' => __('Settings'),
            'description' => __('Manage app settings')
        ],
        'children' => [
            'general-settings' => [
                'name' => 'general-settings',
                'slug' => url(config('path.admin').'/settings/general'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('General'),
                    'description' => __('Manage General site settings'),
                ],
            ],
            'themes-settings' => [
                'name' => 'themes-settings',
                'slug' => url(config('path.admin').'/settings/themes'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Themes'),
                    'description' => __('Manage Themes for the site and application'),
                ],
            ],
        ],
    ],
];
