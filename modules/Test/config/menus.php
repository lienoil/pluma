<?php

return [
    /**
     *--------------------------------------------------------------------------
     * Tests Menus
     *--------------------------------------------------------------------------
     *
     * Specify here the menus to appear on the sidebar.
     *
     */
    'test' => [
        'name' => 'test',
        'order' => 51,
        'slug' => route('tests.index'),
        'always_viewable' => false,
        'icon' => '',
        'labels' => [
            'title' => __('Courses'),
            'description' => __('Manage tests'),
        ],
        'children' => [
            'view-tests' => [
                'name' => 'view-tests',
                'order' => 1,
                'slug' => route('tests.index'),
                'code' => 'tests.index',
                'always_viewable' => false,
                'labels' => [
                    'title' => __('All Courses'),
                    'description' => __('View the list of all tests'),
                ],
            ],
            'create-test' => [
                'name' => 'create-test',
                'order' => 2,
                'slug' => route('tests.create'),
                'code' => 'tests.create',
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Create Course'),
                    'description' => __('Create a Test'),
                ],
            ],
            'trashed-test' => [
                'name' => 'trashed-test',
                'order' => 3,
                'slug' => route('tests.trashed'),
                'code' => 'tests.trashed',
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Trashed Courses'),
                    'description' => __('View list of all tests moved to trash'),
                ],
            ],
        ],
    ],
];
