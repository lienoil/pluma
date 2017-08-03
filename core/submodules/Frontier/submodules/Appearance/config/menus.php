<?php

return [
    'appearance' => [
        'name' => 'appearance',
        'is_parent' => true,
        'order' => 600,
        'slug' => url(config('path.admin').'/appearance'),
        'always_viewable' => true,
        'icon' => 'palette',
        'labels' => [
            'title' => __('Appearance'),
        ],
        'children' => [
            'all-menus' => [
                'name' => 'all-menus',
                'parent' => 'appearance',
                'order' => 4,
                'slug' => url(config('path.admin').'/appearance/menus'),
                'always_viewable' => false,
                'icon' => 'list',
                'labels' => [
                    'title' => __('Menus'),
                ],
            ],
        ],
    ],
];
