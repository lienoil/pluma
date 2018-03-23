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
        'slug' => url('courses'),
        'always_viewable' => false,
        'icon' => 'fa-book',
        'labels' => [
            'title' => __('Courses'),
            'description' => __('Manage courses'),
        ],
        'children' => [

            /**
             *------------------------------------------------------------------
             * Administrative Routes for Courses
             *------------------------------------------------------------------
             *
             * These routes will be handled by CourseController.
             * This are the typical CRUD menus including index, create,
             * and trashed.
             *
             */
            'view-course' => [
                'name' => 'view-course',
                'order' => 1,
                'slug' => route('courses.index'),
                'routes' => [
                    'name' => 'courses.index',
                    'children' => [
                        'courses.edit',
                        'courses.show',
                    ]
                ],
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Manage Courses'),
                    'description' => __('Manage list of all courses'),
                ],
            ],

            'create-course' => [
                'name' => 'create-course',
                'order' => 2,
                'slug' => route('courses.create'),
                'route' => 'courses.create',
                // 'icon' => 'fa-book',
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Create Course'),
                    'description' => __('Create a Course'),
                ],
            ],

            'trashed-course' => [
                'name' => 'trashed-course',
                'order' => 11,
                'slug' => route('courses.trashed'),
                'route' => 'courses.trashed',
                'icon' => 'delete',
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Trashed Courses'),
                    'description' => __('View list of all courses moved to trash'),
                ],
            ],

            /**
             *------------------------------------------------------------------
             * Public Courses
             *------------------------------------------------------------------
             *
             * These entry includes routes from routes/public.php and serves as
             * a sidebar shortcut link.
             *
             */
            'all-courses' => [
                'name' => 'all-courses',
                'order' => 5,
                'slug' => route('courses.all'),
                'always_viewable' => true,
                'routes' => [
                    'name' => 'courses.all',
                    'children' => [
                        'courses.single',
                    ]
                ],
                'always_viewable' => true,
                'labels' => [
                    'title' => __('All Courses'),
                    'description' => __('View list of all courses'),
                ],
            ],

            /**
             *------------------------------------------------------------------
             * My Courses
             *------------------------------------------------------------------
             *
             * These routes will be handled by MyCourseController.
             * They can be found in routes/admin.php # My Courses
             *
             */
            'my-courses' => [
                'name' => 'my-courses',
                'order' => 6,
                'slug' => route('courses.my'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('My Courses'),
                    'description' => __('View your current courses'),
                ],
            ],

            'bookmarked-courses' => [
                'name' => 'bookmarked-courses',
                'order' => 7,
                'slug' => route('courses.bookmarked'),
                'icon' => 'bookmark',
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Bookmarked Courses'),
                    'description' => __('View all your bookmarked courses'),
                ],
            ],


            /**
             *------------------------------------------------------------------
             * Category Menu
             *------------------------------------------------------------------
             *
             */
            'divider-for-course-category' => [
                'name' => 'divider-for-course-category',
                'is_header' => true,
                'is_divider' => true,
                'parent' => 'course',
                'order' => 12,
            ],

            'course-category' => [
                'name' => 'course-category',
                'order' => 13,
                'slug' => route('courses.categories.index'),
                'always_viewable' => false,
                'icon' => 'label',
                'labels' => [
                    'title' => __('Categories'),
                    'description' => __('View list of all course categories'),
                ],
            ],
        ],
    ],
];
