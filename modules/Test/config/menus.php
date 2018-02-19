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
        'router' => 'index',
        'routername' => 'tests',
        'always_viewable' => false,
        'icon' => 'developer_mode',
        'labels' => [
            'title' => __('Tests'),
            'description' => __('Manage tests'),
        ],
        'children' => [
            'index-tests' => [
                'name' => 'index-tests',
                'order' => 1,
                'slug' => route('tests.index'),
                'router' => 'index',
                'routername' => 'tests',
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
                'router' => 'create',
                'routername' => 'tests',
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Add New Test'),
                    'description' => __('Create a Test'),
                ],
            ],
            'trashed-tests' => [
                'name' => 'trashed-tests',
                'order' => 3,
                'slug' => route('tests.trashed'),
                'router' => 'trashed',
                'routername' => 'tests',
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Trashed Tests'),
                    'description' => __('View list of all tests moved to trashed'),
                ],
            ],
        ],
    ],
];
