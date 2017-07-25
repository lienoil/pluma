<?php

return [
    'management' => [
        'name' => 'management',
        'is_header' => true,
        'order' => 499,
        'class' => 'separator',
        'markup' => 'span',
        'text' => __('Management'),
    ],

    /**
     * ------------------------------------
     * Settings
     * ------------------------------------
     *
     */
    'settings' => [
        'name' => 'settings',
        'is_parent' => true,
        'order' => 500,
        'slug' => url(config('path.admin').'/settings'),
        'always_viewable' => false,
        'icon' => 'settings',
        'labels' => [
            'title' => __('Settings'),
            'description' => __('Manage app settings')
        ],
    ],
];
