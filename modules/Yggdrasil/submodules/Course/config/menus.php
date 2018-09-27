<?php

return [
    /**
     * -----------------------------------------------------
     * Courses Menus
     * -----------------------------------------------------
     *
     * Specify here the menus to appear on the sidebar.
     *
     *
     */
    'course' => [
        'name' => 'course',
        'order' => 25,
        'slug' => url('courses'),
        'always_viewable' => false,
        'icon' => 'collections_bookmark',
        'labels' => [
            'title' => __('Courses'),
            'description' => __('Manage Courses'),
        ],
        'children' => [
            /**
             * --------------------------------------------
             * Administrative Routes for Courses
             * --------------------------------------------
             *
             * These routes will be handled by CourseController.
             * This are the typical CRUD menus including index,
             * create and trashed.
             *
             */
            'view-course' => [
                'name' => 'view-course',
                'order' => 2,
                'slug' => route('courses.index'),
                'routes' => [
                    'name' => 'view-course',
                    'children' => [
                        'courses.edit',
                        'courses.show',
                    ]
                ],
                'always_viewable' => false,
                'labels' => [
                    'title' => __('All Courses'),
                    'description' => __('Manage list of all courses'),
                ],
            ],

            'create-course' => [
                'name' => 'create-course',
                'order' => 3,
                'slug' => route('courses.create'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Create Courses'),
                    'description' => __('Create a Course'),
                ],
            ],

            'trashed-course' => [
                'name' => 'trashed-course',
                'order' => 4,
                // 'slug' => route('courses.trashed'),
                // 'code' => 'courses.trashed',
                'icon' => 'delete',
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Trashed Courses'),
                    'description' => __('View list of all courses moved to trash'),
                ],
            ],

            /**
             * --------------------------------------------
             * Public Courses
             * --------------------------------------------
             *
             * These entry includes routes from routes/public.php and serve as
             * a sidebar shortcut link.
             *
             */
            'all-course' => [
                'name' => 'all-course',
                'order' => 5,
                'slug' => route('courses.all'),
                'code' => 'courses.all',
                'always_viewable' => false,
                'exclude_from_root' => true,
                'routes' => [
                    'name' => 'all-course',
                    'children' => [
                        'courses.single',
                    ],
                ],
                'labels' => [
                    'title' => __('All Courses'),
                    'description' => __('View list of all courses'),
                ],
            ],

            /**
             * ---------------------------------------------
             * My Courses
             * ---------------------------------------------
             *
             * These routes will be handled by MyCourseController.
             * They can be found in routes/admin.php # MyCourses
             */
            'my-courses' => [
                'name' => 'my-courses',
                'code' => 'courses.my',
                'order' => 6,
                'slug' => route('courses.my'),
                'always_viewable' => false,
                'exclude_from_root' => true,
                'labels' => [
                    'title' => __('My Courses'),
                    'description' => __('View your current courses'),
                ],
            ],

            'bookmarked-courses' => [
                'name' => 'bookmarked-courses',
                'code' => 'courses.bookmarked',
                'order' => 7,
                'slug' => route('courses.bookmarked'),
                'icon' => 'bookmark',
                'always_viewable' => false,
                'exclude_from_root' => true,
                'labels' => [
                    'title' => __('Bookmarked Courses'),
                    'description' => __('View all your bookmarked courses'),
                ],
            ],
        ]
    ]
];
