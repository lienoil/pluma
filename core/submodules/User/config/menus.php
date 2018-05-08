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
                'code' => 'users.index',
                'routename' => 'users.index',
                'component' => 'components/Pluma/User/Index.vue',
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
                'slug' => route('users.create'),
                'code' => 'users.create',
                'always_viewable' => false,
                'routename' => 'users.create',
                'component' => 'components/Pluma/User/Create.vue',
                'routes' => [
                    'name' => 'users.create',
                ],
                'labels' => [
                    'title' => __('Create User'),
                    'description' => __('Create new user'),
                ],
            ],
            'trashed-user' => [
                'name' => 'trashed-user',
                'order' => 3,
                'slug' => route('users.trashed'),
                'code' => 'users.trashed',
                'routename' => 'users.trashed',
                'component' => 'components/Pluma/User/Trashed.vue',
                'icon' => 'delete',
                'always_viewable' => false,
                'routes' => [
                    'name' => 'users.trashed',
                ],
                'labels' => [
                    'title' => __('Trashed Users'),
                    'description' => __('View list of trashed users'),
                ],
            ],
        ],
    ],
];
