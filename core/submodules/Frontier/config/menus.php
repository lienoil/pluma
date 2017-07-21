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

    'page' => [
        'name' => 'page',
        'is_parent' => true,
        'order' => 2,
        'slug' => url(config('path.admin').'/pages'),
        'always_viewable' => false,
        'icon' => 'insert_drive_file',
        'labels' => [
            'title' => __('Pages'),
        ],
        'children' => [
            'all-pages' => [
                'name' => 'all-pages',
                'parent' => 'page',
                'order' => 1,
                'slug' => url(config('path.admin').'/pages'),
                'always_viewable' => false,
                // 'icon' => 'web',
                'labels' => [
                    'title' => __('All Pages'),
                ],
            ],
            'create-page' => [
                'name' => 'create-page',
                'parent' => 'page',
                'order' => 2,
                'slug' => url(config('path.admin').'/pages/create'),
                'always_viewable' => false,
                // 'icon' => '<span class="material-icon">insert drive file</span>',
                'labels' => [
                    'title' => __('Create Page'),
                ],
            ],
            'trashed-pages' => [
                'name' => 'trashed-pages',
                'parent' => 'page',
                'order' => 3,
                'slug' => url(config('path.admin').'/pages/trashed'),
                'always_viewable' => false,
                'icon' => 'delete',
                'labels' => [
                    'title' => __('Trashed Pages'),
                ],
            ],
        ],
    ],
];
