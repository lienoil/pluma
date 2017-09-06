<?php

return [
    'divider-role' => [
        'name' => 'divider-role',
        'is_header' => true,
        'is_divider' => true,
        'parent' => 'user',
        'order' => 9,
    ],

    'view-role' => [
        'name' => 'view-role',
        'slug' => url(config('path.admin').'/users/roles'),
        'routes' => [
            'name' => 'roles.index',
            'children' => [
                'roles.create',
                'roles.edit',
                'roles.show',
                'roles.trash',
            ]
        ],
        'parent' => 'user',
        'order' => 10,
        'always_viewable' => false,
        'icon' => 'supervisor_account',
        'labels' => [
            'title' => __('Roles'),
            'description' => __('View the list of all roles'),
        ],
    ],

    'view-grant' => [
        'name' => 'view-grant',
        'slug' => url(config('path.admin').'/users/grants'),
        'parent' => 'user',
        'order' => 20,
        'routes' => [
            'name' => 'grants.index',
            'children' => [
                'grants.create',
                'grants.edit',
                'grants.show',
                'grants.trash',
            ]
        ],
        'always_viewable' => false,
        'icon' => 'lock_open',
        'labels' => [
            'title' => __('Grants'),
            'description' => __('View the list of all grants'),
        ],
    ],

    'view-permission' => [
        'name' => 'view-permission',
        'slug' => url(config('path.admin').'/users/permissions'),
        'parent' => 'user',
        'order' => 30,
        'routes' => [
            'name' => 'permissions.index',
            'children' => [
                'permissions.create',
                'permissions.edit',
                'permissions.show',
                'permissions.trash',
                'permissions.refresh',
                'permissions.reset',
            ]
        ],
        'always_viewable' => false,
        'icon' => 'lock_outline',
        'labels' => [
            'title' => __('Permissions'),
            'description' => __('View the list of all permissions'),
        ],
    ],
];
