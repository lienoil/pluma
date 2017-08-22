<?php

return [
    'page' => [
        'name' => 'page',
        'is_parent' => true,
        'order' => 10,
        'slug' => url(config('path.admin').'/pages'),
        'always_viewable' => false,
        'icon' => 'insert_drive_file',
        'labels' => [
            'title' => __('Pages'),
        ],
        'children' => [
            'view-pages' => [
                'name' => 'view-pages',
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
            'trash-page' => [
                'name' => 'trash-page',
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
