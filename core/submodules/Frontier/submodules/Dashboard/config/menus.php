<?php

return [
    'content' => [
        'name' => 'content',
        'is_header' => true,
        'order' => 0,
        'class' => 'separator',
        'markup' => 'span',
        'text' => __('Content'),
    ],

    'dashboard' => [
        'name' => 'dashboard',
        'is_parent' => true,
        'order' => 1,
        'slug' => url(config('path.admin').'/dashboard'),
        'always_viewable' => true,
        'icon' => 'widgets',
        'labels' => [
            'title' => __('Dashboard'),
        ],
    ],

    /*'sample-separator' => [
        'name' => 'sample-separator',
        'is_separator' => true,
        'order' => 3,
        'class' => 'mdl--separator',
        'markup' => 'hr',
    ],*/
];
