<?php

return [
    /**
     *--------------------------------------------------------------------------
     * Tests Menus
     *--------------------------------------------------------------------------
     * Specify here the menus to appear on the sidebar.
     *
     */
    'test' => [
        'name' => 'test',
        'order' => 51,
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
            'divider-for-octocat' => [
                'name' => 'divider-for-octocat',
                'is_header' => true,
                'is_divider' => true,
                'parent' => 'test',
                'order' => 12,
            ],

            'view-octocat' => [
                'name' => 'view-octocat',
                'order' => 13,
                'slug' => route('tests.octocats.index'),
                'always_viewable' => false,
                'icon' => 'bubble_chart',
                'labels' => [
                    'title' => __('Octocat'),
                    'description' => __('For test module purposes.'),
                ],
            ],
        ],
    ],
];
