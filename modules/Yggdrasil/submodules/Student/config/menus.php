<?php

return [
    /**
     *--------------------------------------------------------------------------
     * Students Menus
     *--------------------------------------------------------------------------
     * Specify here the menus to appear on the sidebar.
     *
     */
    'student' => [
        'name' => 'student',
        'order' => 51,
        'slug' => route('students.index'),
        'always_viewable' => false,
        'icon' => '',
        'labels' => [
            'title' => __('Students'),
            'description' => __('Manage students'),
        ],
        'children' => [
            'view-student' => [
                'name' => 'view-student',
                'order' => 1,
                'slug' => route('students.index'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('All Students'),
                    'description' => __('View the list of all students'),
                ],
            ],
            'create-student' => [
                'name' => 'create-student',
                'order' => 2,
                'slug' => route('students.create'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Create Student'),
                    'description' => __('Create a Student'),
                ],
            ],
            // 'trash-student' => [
            //     'name' => 'trash-student',
            //     'order' => 3,
            //     'slug' => route('students.trash'),
            //     'always_viewable' => false,
            //     'labels' => [
            //         'title' => __('Trashed Students'),
            //         'description' => __('View list of all students moved to trash'),
            //     ],
            // ],
        ],
    ],
];
