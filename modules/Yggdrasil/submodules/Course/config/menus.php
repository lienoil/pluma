<?php

return [
    /**
     *--------------------------------------------------------------------------
     * Courses Menus
     *--------------------------------------------------------------------------
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
            'manage-courses-group' => [
                'name' => 'manage-courses-group',
                'slug' => route('courses.index'),
                'order' => 1,
                'is_group_link' => true,
                'always_viewable' => false,
                'display_as_header' => true,
                'icon' => 'supervisor_account',
                'labels' => [
                    'title' => __('Manage Courses'),
                    'description' => __('Manage all courses.'),
                ],
                'routes' => [
                    'name' => 'courses.index',
                    'children' => [
                        'courses.edit',
                        'courses.create',
                        'courses.show',
                        'courses.trashed',
                    ]
                ],
                'children' => [
                    'view-course' => [
                        'name' => 'view-course',
                        'order' => 1,
                        'slug' => route('courses.index'),
                        'route' => 'courses.index',
                        // 'icon' => 'supervisor_account',
                        'always_viewable' => false,
                        'labels' => [
                            'title' => __('All Courses'),
                            'description' => __('Manage list of all courses'),
                        ],
                    ],
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
                'order' => 3,
                'slug' => route('courses.trashed'),
                'route' => 'courses.trashed',
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Trashed Courses'),
                    'description' => __('View list of all courses moved to trash'),
                ],
            ],
            'view-enrolled-courses' => [
                'name' => 'view-enrolled-courses',
                'order' => 2,
                'slug' => route('courses.enrolled.index'),
                'always_viewable' => true,
                'routes' => [
                    'name' => 'courses.enrolled.index',
                    'children' => [
                        'courses.enrolled.show',
                    ]
                ],
                'labels' => [
                    'title' => __('My Courses'),
                    'description' => __('View your currently enrolled courses'),
                ],
            ],
            'all-courses' => [
                'name' => 'all-courses',
                'order' => 2,
                'slug' => route('courses.all'),
                'routes' => [
                    'name' => 'courses.all',
                    'children' => [
                        'courses.single',
                    ]
                ],
                'always_viewable' => true,
                'labels' => [
                    'title' => __('All Courses'),
                    'description' => __('View the list of all courses'),
                ],
            ],

            'view-bookmarked-courses' => [
                'name' => 'view-bookmarked-courses',
                'order' => 10,
                'icon' => 'bookmark',
                'slug' => route('courses.bookmark.index'),
                'always_viewable' => true,
                'labels' => [
                    'title' => __('Bookmarked'),
                    'description' => __('View all your bookmarked courses'),
                ],
            ],

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


    /**
     *--------------------------------------------------------------------------
     * Profile Menus
     *--------------------------------------------------------------------------
     *
     * Specify here the menus to appear on the sidebar.
     *
     */
    // 'show-course' => [
    //     'name' => 'show-course',
    //     'order' => 55,
    //     'slug' => route('profile.courses.show', user()->handlename),
    //     'route' => 'profile.courses.show',
    //     'always_viewable' => false,
    //     'parent' => 'profile-group',
    //     'icon' => 'fa-book',
    //     'labels' => [
    //         'title' => __('My Courses'),
    //         'description' => __('View your courses here'),
    //     ],
    // ],
];
