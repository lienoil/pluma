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
        'always_viewable' => true,
        'icon' => 'settings',
        'labels' => [
            'title' => __('Settings'),
            'description' => __('Manage app settings')
        ],
        'children' => [
            'general-settings' => [
                'name' => 'general-settings',
                'slug' => url(config('path.admin').'/settings/general'),
                'labels' => [
                    'title' => __('General'),
                    'description' => __('Lorem ipsum dolor sit.'),
                ],
            ],
            'profile-settings' => [
                'name' => 'profile-settings',
                'slug' => url(config('path.admin').'/settings/profile'),
                'labels' => [
                    'title' => __('Profile'),
                    'description' => __('Lorem ipsum dolor sit.'),
                ],
            ],
            'theme-settings' => [
                'name' => 'theme-settings',
                'slug' => url(config('path.admin').'/settings/theme'),
                'labels' => [
                    'title' => __('Theme'),
                    'description' => __('Lorem ipsum dolor sit.'),
                ],
            ],
        ],
    ],
];
