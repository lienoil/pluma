<?php

return [
    /**
     * -------------------------------------------------------------------------
     * Forums Menus
     * -------------------------------------------------------------------------
     * Specify here the menus to appear on the sidebar.
     *
     */
    'forum' => [
        'name' => 'forum',
        'order' => 51,
        'slug' => url(config('path.admin').'/forums'),
        'always_viewable' => false,
        'icon' => 'forum',
        'labels' => [
            'title' => __('Forums'),
            'description' => __('Manage forums'),
        ],
        'children' => [
            'view-forums' => [
                'name' => 'view-forums',
                'order' => 1,
                'slug' => url(config('path.admin').'/forums'),
                'always_viewable' => false,
                 'routes' => [
                    'name' => 'forums.index',
                    'children' => [
                        'forums.edit',
                        'forums.show',
                    ]
                ],
                'labels' => [
                    'title' => __('All Forums'),
                    'description' => __('View the list of all forums'),
                ],
            ],
            'create-forum' => [
                'name' => 'create-forum',
                'order' => 2,
                'slug' => url(config('path.admin').'/forums/create'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Create'),
                    'description' => __('Create a Forum'),
                ],
            ],
            'trashed-forums' => [
                'name' => 'trashed-forums',
                'order' => 3,
                'slug' => url(config('path.admin').'/forums/trash'),
                'always_viewable' => false,
                'icon' => 'delete',
                'labels' => [
                    'title' => __('Trashed'),
                    'description' => __('View list of all forums moved to trash'),
                ],
            ],
        ],
    ],
];
