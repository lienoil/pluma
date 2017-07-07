<?php

return [
    'all-roles' => [
        'name' => 'all-roles',
        'slug' => url(config('path.admin').'/roles'),
        'parent' => 'user',
        'order' => 10,
        // 'is_parent' => true,
        'always_viewable' => false,
        'icon' => '',
        'labels' => [
            'title' => __('Roles'),
        ],
    ],

    'all-permissions' => [
        'name' => 'all-permissions',
        'slug' => url(config('path.admin').'/permissions'),
        'parent' => 'user',
        'order' => 11,
        'is_parent' => true,
        'always_viewable' => false,
        'icon' => '',
        'labels' => [
            'title' => __('Permissions'),
        ],
    ],
];
