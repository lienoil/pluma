<?php

return [
    'page' => [
        'name' => 'page',
        'is_parent' => true,
        'order' => 30,
        'slug' => route('pages.index'),
        'always_viewable' => false,
        'icon' => 'insert_drive_file',
        'labels' => [
            'title' => __('Pages'),
        ],
        'children' => [
            'view-page' => [
                'name' => 'view-page',
                'parent' => 'page',
                'order' => 1,
                'slug' => route('pages.index'),
                'always_viewable' => false,
                'routes' => [
                    'name' => 'pages.index',
                    'children' => [
                        'pages.edit',
                        'pages.show',
                    ]
                ],
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
                'labels' => [
                    'title' => __('Create Page'),
                ],
            ],
            'trashed-page' => [
                'name' => 'trashed-page',
                'parent' => 'page',
                'order' => 3,
                'slug' => route('pages.trashed'),
                'always_viewable' => false,
                'icon' => 'delete',
                'labels' => [
                    'title' => __('Trashed Pages'),
                ],
            ],
        ],
    ],
];
