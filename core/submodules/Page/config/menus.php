<?php

return [
    'page' => [
        'name' => 'page',
        'is_parent' => true,
        'order' => 30,
        'slug' => '#',
        'always_viewable' => false,
        'icon' => 'find_in_page',
        'labels' => [
            'title' => __('Pages'),
            'description' => __('Manage site pages'),
        ],
        'children' => [
            'view-pages' => [
                'name' => 'view-pages',
                'code' => 'pages.index',
                'slug' => route('pages.index'),
                'routename' => 'pages.index',
                'component' => 'components/Pluma/Page/Index.vue',
                'parent' => 'page',
                'order' => 1,
                'always_viewable' => false,
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
            'create-page' => [
                'name' => 'create-page',
                'code' => 'pages.create',
                'routename' => 'pages.create',
                'component' => 'components/Pluma/Page/Create.vue',
                'parent' => 'page',
                'order' => 2,
                'slug' => route('pages.create'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Create Page'),
                    'description' => __('Create new page'),
                ],
            ],
            'trashed-pages' => [
                'name' => 'trashed-pages',
                'code' => 'pages.trashed',
                'routename' => 'pages.trashed',
                'component' => 'components/Pluma/Page/Trashed.vue',
                'order' => 3,
                'slug' => route('pages.trashed'),
                'always_viewable' => false,
                'icon' => 'delete',
                'labels' => [
                    'title' => __('Trashed Pages'),
                    'description' => __('View list of all trashed pages'),
                ],
            ],
        ],
    ],
];
