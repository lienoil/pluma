<?php

return [
    /**
     * -----------------------------------
     * Users
     * -----------------------------------
     *
     */
    'user' => [
        'name' => 'user',
        'order' => 600,
        'slug' => url(config('path.admin').'/users'),
        'always_viewable' => false,
        'icon' => 'account_box',
        'labels' => [
            'title' => __('Users'),
        ],
        'children' => [
            'all-users' => [
                'name' => 'all-users',
                'order' => 1,
                'slug' => url(config('path.admin').'/users'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('All Users'),
                ],
            ],
            'create-user' => [
                'name' => 'create-user',
                'order' => 2,
                'slug' => url(config('path.admin').'/users/create'),
                'always_viewable' => false,
                // 'icon' => 'account',
                'labels' => [
                    'title' => __('Create User'),
                ],
            ],
            'trashed-users' => [
                'name' => 'trashed-users',
                'order' => 3,
                'slug' => url(config('path.admin').'/pages/trashed'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Trashed Users'),
                ],
            ],
        ],
    ],
];
