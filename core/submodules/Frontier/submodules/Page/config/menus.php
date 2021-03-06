<?php

return [
    'page' => [
        'name' => 'page',
        'is_parent' => true,
        'order' => 30,
        // 'slug' => route('pages.index'),
        'always_viewable' => false,
        'icon' => 'find_in_page',
        'labels' => [
            'title' => __('Pages'),
        ],
        'children' => [
            'view-page' => [
                'name' => 'view-page',
                'routename' => 'pages.index',
                'component' => 'components/Pluma/Page/Index.vue',
                'parent' => 'page',
                'order' => 1,
                'slug' => route('pages.index'),
                'always_viewable' => false,
                'routes' => [
                    'name' => 'pages.index',
                    'children' => [
                        'pages.edit',
                        'pages.show',
                    ]
                ],
                'labels' => [
                    'title' => __('All Pages'),
                ],
            ],
            'create-page' => [
                'name' => 'create-page',
                'routename' => 'pages.create',
                'component' => 'components/Pluma/Page/Create.vue',
                'parent' => 'page',
                'order' => 2,
                'slug' => route('pages.create'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Create Page'),
                ],
            ],
            'trashed-page' => [
                'name' => 'trashed-page',
                'routename' => 'pages.trashed',
                'component' => 'components/Pluma/Page/Trashed.vue',
                'order' => 3,
                'slug' => route('pages.trashed'),
                'always_viewable' => false,
                'icon' => 'delete',
                'labels' => [
                    'title' => __('Trashed Pages'),
                    'description' => __('View the list of all trashed pages'),
                ],
            ],

            // 'page-category-divider' => [
            //     'name' => 'page-category-divider',
            //     'is_header' => true,
            //     'is_divider' => true,
            //     'parent' => 'user',
            //     'order' => 9,
            // ],

            // 'view-pages-category' => [
            //     'name' => 'view-pages-category',
            //     'slug' => route('pages.categories.index'),
            //     'routes' => [
            //         'name' => 'pages.categories.index',
            //         'children' => [
            //             'pages.categories.edit',
            //             'pages.categories.trashed',
            //         ]
            //     ],
            //     'order' => 10,
            //     'always_viewable' => false,
            //     'icon' => 'label',
            //     'labels' => [
            //         'title' => __('Categories'),
            //         'description' => __('View the list of all categories'),
            //     ],
            // ],
        ],
    ],
];
