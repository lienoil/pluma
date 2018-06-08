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
            'title' => __('Accounts'),
            'description' => __("Manage users, roles, and permissions"),
        ],
        'children' => [
            'view-user' => [
                'name' => 'view-user',
                'order' => 1,
                'slug' => route('users.index'),
                'code' => 'users.index',
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
                    'title' => __('All Accounts'),
                    'description' => 'View list of all users'
                ],
            ],

            'create-user' => [
                'name' => 'create-user',
                'order' => 2,
                'slug' => route('users.create'),
                'code' => 'users.create',
                'always_viewable' => false,
                'component' => 'components/Pluma/User/Create.vue',
                'routes' => [
                    'name' => 'users.create',
                ],
                'labels' => [
                    'title' => __('Create Account'),
                    'description' => __('Create new user account'),
                ],
            ],
            'trashed-user' => [
                'name' => 'trashed-user',
                'order' => 3,
                'slug' => route('users.trashed'),
                'code' => 'users.trashed',
                'component' => 'components/Pluma/User/Trashed.vue',
                'icon' => 'delete',
                'always_viewable' => false,
                'routes' => [
                    'name' => 'users.trashed',
                ],
                'labels' => [
                    'title' => __('Deactivated Accounts'),
                    'description' => __('View list of deactivated users'),
                ],
            ],
        ],
    ],
];
