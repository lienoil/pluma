<?php

return [
    'dashboard' => [
        'name' => 'dashboard',
        'is_parent' => true,
        'order' => 0,
        'slug' => url(config('path.admin').'/dashboard'),
        'always_viewable' => true,
        'icon' => 'widgets',
        'labels' => [
            'title' => __('Dashboard'),
            'description' => __('View summary and overview of the app.'),
        ],
    ],

    'content' => [
        'name' => 'content',
        'is_header' => true,
        // 'always_viewable' => true,
        'order' => 1,
        'class' => 'separator',
        'markup' => 'span',
        'text' => __('Content'),
    ],
];
