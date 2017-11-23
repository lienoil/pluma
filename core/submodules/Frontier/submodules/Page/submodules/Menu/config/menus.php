<?php

return [
    /**
     * -------------------------------------------------------------------------
     * Menus Menus
     * -------------------------------------------------------------------------
     * Specify here the menus to appear on the sidebar.
     *
     */
    'menu' => [
        'name' => 'menu',
        'order' => 51,
        'slug' => url(config('path.admin').'/menus'),
        'always_viewable' => false,
        'icon' => '',
        'labels' => [
            'title' => __('Menus'),
            'description' => __('Manage menus'),
        ],
        'children' => [
            'view-menu' => [
                'name' => 'view-menu',
                'order' => 1,
                'slug' => url(config('path.admin').'/menus'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('All Menus'),
                    'description' => __('View the list of all menus'),
                ],
            ],
            'create-menu' => [
                'name' => 'create-menu',
                'order' => 2,
                'slug' => url(config('path.admin').'/menus/create'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Create Menu'),
                    'description' => __('Create a Menu'),
                ],
            ],
            'trashed-menu' => [
                'name' => 'trashed-menu',
                'order' => 3,
                'slug' => url(config('path.admin').'/menus/trashed'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Trashed Menus'),
                    'description' => __('View list of all menus moved to trash'),
                ],
            ],
        ],
    ],
];
