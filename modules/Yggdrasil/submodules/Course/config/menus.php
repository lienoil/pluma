<?php

return [
    /**
     * -------------------------------------------------------------------------
     * Courses Menus
     * -------------------------------------------------------------------------
     * Specify here the menus to appear on the sidebar.
     *
     */
    'course' => [
        'name' => 'course',
        'order' => 51,
        'slug' => url(config('path.admin').'/courses'),
        'always_viewable' => false,
        'icon' => 'fa-book',
        'labels' => [
            'title' => __('Courses'),
            'description' => __('Manage courses'),
        ],
        'children' => [
            'view-courses' => [
                'name' => 'view-courses',
                'order' => 1,
                'slug' => url(config('path.admin').'/courses'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('All Courses'),
                    'description' => __('View the list of all courses'),
                ],
            ],
            'create-course' => [
                'name' => 'create-course',
                'order' => 2,
                'slug' => url(config('path.admin').'/courses/create'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Create Course'),
                    'description' => __('Create a Course'),
                ],
            ],
            'trashed-courses' => [
                'name' => 'trashed-courses',
                'order' => 3,
                'slug' => url(config('path.admin').'/courses/trashed'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Trashed Courses'),
                    'description' => __('View list of all courses moved to trash'),
                ],
            ],
        ],
    ],
];
