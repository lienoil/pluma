<?php

return [
    'content' => [
        'name' => 'content',
        'is_header' => true,
        'order' => 0,
        'slug' => '#',
        'always_viewable' => true,
        'labels' => [
            'title' => 'Content',
        ],
    ],

    'dashboard' => [
        'name' => 'dashboard',
        'is_parent' => true,
        'order' => 1,
        'slug' => 'dashboard',
        'always_viewable' => true,
        'icon' => 'widgets',
        'labels' => [
            'title' => 'Dashboard',
        ],
    ],
];
