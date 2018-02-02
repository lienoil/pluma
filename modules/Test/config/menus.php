<?php

return [
    /**
     * -------------------------------------------------------------------------
     * Tests Menus
     * -------------------------------------------------------------------------
     * Specify here the menus to appear on the sidebar.
     *
     */
    'test' => [
        'name' => 'test',
        'order' => 100,
        'slug' => route('tests.index'),
        'always_viewable' => false,
        'icon' => 'developer_mode',
        'labels' => [
            'title' => __('Tests'),
            'description' => __('Manage tests'),
        ],
        'children' => [
            'view-test' => [
                'name' => 'view-test',
                'order' => 1,
                'slug' => route('tests.index'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('All Tests'),
                    'description' => __('View the list of all tests'),
                ],
            ],
            'create-test' => [
                'name' => 'create-test',
                'order' => 2,
                'slug' => route('tests.create'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Create Test'),
                    'description' => __('Create a Test'),
                ],
            ],
            // 'trash-test' => [
            //     'name' => 'trash-test',
            //     'order' => 3,
            //     'slug' => route('tests.trash'),
            //     'always_viewable' => false,
            //     'labels' => [
            //         'title' => __('Trashed Tests'),
            //         'description' => __('View list of all tests moved to trash'),
            //     ],
            // ],
        ],
    ],
];
