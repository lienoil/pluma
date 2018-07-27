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
                'always_viewable' => true,
                'exclude_from_root' => true,
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
            /**
             * ----------------------------------------------------------------------
             *  My Courses
             * ----------------------------------------------------------------------
             *
             * These routes will be handled by MyCourseController.
             * # My Courses
             */
            'my-courses' => [
                'name' => 'my-courses',
                'order' => 6,
                'slug' => route('courses.my'),
                'code' => 'my-courses',
                'always_viewable' => false,
                'exclude_from_root' => true,
                'labels' => [
                    'title' => __('My Courses'),
                    'description' => __('View your current courses'),
                ],
            ],

            /**
             * --------------------------------------------------------------------
             * Bookmark Course
             * --------------------------------------------------------------------
             */
           'bookmarked-courses' => [
                'name' => 'bookmarked-courses',
                'order' => 7,
                'slug' => route('courses.bookmarked'),
                'code' => 'bookmarked-courses',
                'always_viewable' => false,
                // 'exclude_from_root' => true,
                'labels' => [
                    'title' => __('Bookmarked Courses'),
                    'description' => __('View all your bookmarked courses'),
                ],
            ],
        ],
    ],
];
            // 'all-courses' => [
            //     'name' => 'all-courses',
            //     'permission' => 'all-courses',
            //     'order' => 5,
            //     'slug' => route('courses.all'),
            //     'code' => 'all-courses',
            //     'always_viewable' => false,
            //     'exclude_from_root' => true,
            //     'routes' => [
            //         'name' => 'courses.all',
            //         'children' => [
            //             'courses.single',
            //         ]
            //     ],
            //     'labels' => [
            //         'title' => __('All Courses'),
            //         'description' => __('View list of all courses'),
            //     ],
            // ],
