<?php

return [
    /**
     * -------------------------------------------------------------------------
     * Tests Menus
     * -------------------------------------------------------------------------
     * Specify here the menus to appear on the sidebar.
     *
     */
    'test' => [
        'name' => 'test',
        'order' => 500,
        'slug' => url(config('path.admin').'/tests'),
        'always_viewable' => false,
        'icon' => 'fa-flask',
        'labels' => [
            'title' => __('Tests'),
            'description' => __('Manage tests'),
        ],
        'children' => [
            'view-test' => [
                'name' => 'view-test',
                'order' => 1,
                'slug' => url(config('path.admin').'/tests'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('All Tests'),
                    'description' => __('View the list of all tests'),
                ],
            ],
            'create-test' => [
                'name' => 'create-test',
                'order' => 2,
                'slug' => url(config('path.admin').'/tests/create'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Create Test'),
                    'description' => __('Create a Test'),
                ],
            ],
            'trashed-test' => [
                'name' => 'trashed-test',
                'order' => 3,
                'slug' => url(config('path.admin').'/tests/trashed'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Trashed Tests'),
                    'description' => __('View list of all tests moved to trash'),
                ],
            ],
        ],
    ],
];
