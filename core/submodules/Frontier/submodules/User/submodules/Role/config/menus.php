<?php

return [
    'all-roles' => [
        'name' => 'all-roles',
        'slug' => url(config('path.admin').'/users/roles'),
        'parent' => 'user',
        'order' => 10,
        // 'is_parent' => true,
        'always_viewable' => false,
        'icon' => 'supervisor_account',
        'labels' => [
            'title' => __('Roles'),
        ],
    ],

    'all-grants' => [
        'name' => 'all-grants',
        'slug' => url(config('path.admin').'/users/grants'),
        'parent' => 'user',
        'order' => 20,
        // 'is_parent' => false,
        'always_viewable' => false,
        'icon' => 'lock_open',
        'labels' => [
            'title' => __('Grants'),
        ],
    ],

    'all-permissions' => [
        'name' => 'all-permissions',
        'slug' => url(config('path.admin').'/users/permissions'),
        'parent' => 'user',
        'order' => 30,
        'always_viewable' => false,
        'icon' => 'lock_outline',
        'labels' => [
            'title' => __('Permissions'),
        ],
    ],
];
