<?php

return [
    /**
     *--------------------------------------------------------------------------
     * Users
     *--------------------------------------------------------------------------
     * Menu configurations.
     *
     */
    'user' => [
        'name' => 'user',
        'order' => 600,
        'slug' => route('users.index'),
        'always_viewable' => false,
        'icon' => 'account_box',
        'labels' => [
            'title' => __('Users'),
            'description' => __("Manage users"),
        ],
        'children' => [
            'view-user' => [
                'name' => 'view-user',
                'order' => 1,
                'slug' => route('users.index'),
                // 'always_viewable' => false,
                'routes' => [
                    'name' => 'users.index',
                    'children' => [
                        'users.edit',
                        'users.show',
                        'password.change.form',
                    ]
                ],
                'labels' => [
                    'title' => __('All Users'),
                    'description' => 'View list of all users'
                ],
            ],

            'create-user' => [
                'name' => 'create-user',
                'order' => 2,
                'slug' => url(config('path.admin').'/users/create'),
                'always_viewable' => false,
                'routes' => [
                    'name' => 'users.create',
                ],
                'labels' => [
                    'title' => __('Create User'),
                ],
            ],
            'trash-user' => [
                'name' => 'trash-user',
                'order' => 3,
                'slug' => url(config('path.admin').'/users/trashed'),
                'always_viewable' => false,
                'routes' => [
                    'name' => 'users.trashed',
                ],
                'labels' => [
                    'title' => __('Trashed Users'),
                ],
            ],
        ],
    ],
];
