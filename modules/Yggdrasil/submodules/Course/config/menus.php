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
        'order' => 25,
        'slug' => route('courses.index'),
        'always_viewable' => false,
        'icon' => 'collections_bookmark',
        'labels' => [
            'title' => __('Courses'),
            'description' => __('Manage courses'),
        ],
        'children' => [
            /**
             *------------------------------------------------------------------
             * Public Routes
             *------------------------------------------------------------------
             *
             */
            'all-courses' => [
                'name' => 'all-courses',
                'order' => 1,
                'slug' => route('courses.all'),
                'code' => 'courses.all',
                'exclude_from_root' => true,
                'always_viewable' => true,
                'labels' => [
                    'title' => __('All Courses'),
                    'description' => __('View the list of courses'),
                ],
            ],

            /**
             *------------------------------------------------------------------
             * Admin Routes
             *------------------------------------------------------------------
             *
             */
            'owned-courses' => [
                'name' => 'owned-courses',
                'order' => 1,
                'slug' => route('courses.all'),
                'code' => 'courses.owned',
                'exclude_from_root' => true,
                'always_viewable' => false,
                'labels' => [
                    'title' => __('My Courses'),
                    'description' => __('View list of your enrolled courses'),
                ],
            ],

            'view-courses' => [
                'name' => 'view-courses',
                'order' => 2,
                'slug' => route('courses.index'),
                'code' => 'courses.index',
                'always_viewable' => false,
                'labels' => [
                    'title' => __('All Courses'),
                    'description' => __('Manage all courses'),
                ],
            ],
            'create-course' => [
                'name' => 'create-course',
                'order' => 3,
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
                'order' => 4,
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
