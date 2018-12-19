<?php

return [
    'page' => [
        'name' => 'page',
        'is_parent' => true,
        'order' => 30,
        'slug' => '#',
        'always_viewable' => false,
        'icon' => 'mdi mdi-file-document-outline',
        'labels' => [
            'title' => __('Pages'),
            'description' => __('Manage site pages'),
        ],
        'children' => [
            'pages.owned' => [
                'name' => 'pages.owned',
                'code' => 'pages.owned',
                'slug' => route('pages.owned'),
                'always_viewable' => false,
                'exclude_from_root' => true,
                'order' => 0,
                'labels' => [
                    'title' => __('My Pages'),
                    'description' => __('Manage my own pages'),
                ],
            ],
            'pages.index' => [
                'name' => 'pages.index',
                'code' => 'pages.index',
                'slug' => route('pages.index'),
                'order' => 1,
                'routes' => [
                    'name' => 'pages.index',
                    'children' => [
                        'pages.edit',
                        'pages.show',
                    ],
                ],
                'labels' => [
                    'title' => __('All Pages'),
                    'description' => __('Manage site pages'),
                ],
            ],
            'pages.create' => [
                'name' => 'pages.create',
                'code' => 'pages.create',
                'order' => 2,
                'slug' => route('pages.create'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Create Page'),
                    'description' => __('Create new page'),
                ],
            ],
            'pages.trashed' => [
                'name' => 'pages.trashed',
                'code' => 'pages.trashed',
                'order' => 3,
                'slug' => route('pages.trashed'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Trashed Pages'),
                    'description' => __('View list of all trashed pages'),
                ],
            ],
        ],
    ],
];
