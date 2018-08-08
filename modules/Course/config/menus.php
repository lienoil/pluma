<?php

return [
    /**
     *--------------------------------------------------------------------------
     * Courses Menus
     *--------------------------------------------------------------------------
     *
     * Specify here the menus to appear on the sidebar.
     *
     */
    'course' => [
        'name' => 'course',
        'order' => 51,
        'slug' => route('courses.index'),
        'always_viewable' => false,
        'icon' => '',
        'labels' => [
            'title' => __('Courses'),
            'description' => __('Manage courses'),
        ],
        'children' => [
            'view-courses' => [
                'name' => 'view-courses',
                'order' => 1,
                'slug' => route('courses.index'),
                'code' => 'courses.index',
                'always_viewable' => false,
                'labels' => [
                    'title' => __('All Courses'),
                    'description' => __('View the list of all courses'),
                ],
            ],
            'create-course' => [
                'name' => 'create-course',
                'order' => 2,
                'slug' => route('courses.create'),
                'code' => 'courses.create',
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Create Course'),
                    'description' => __('Create a Course'),
                ],
            ],
            'trashed-course' => [
                'name' => 'trashed-course',
                'order' => 3,
                'slug' => route('courses.trashed'),
                'code' => 'courses.trashed',
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Trashed Courses'),
                    'description' => __('View list of all courses moved to trash'),
                ],
            ],
        ],
    ],
];
