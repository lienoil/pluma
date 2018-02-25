<?php

return [
    /**
     *--------------------------------------------------------------------------
     * Students Menus
     *--------------------------------------------------------------------------
     * Specify here the menus to appear on the sidebar.
     *
     */
    'view-students' => [
        'name' => 'view-students',
        'order' => 6,
        'parent' => 'course',
        'icon' => 'supervisor-account',
        'slug' => route('students.index'),
        'always_viewable' => false,
        'labels' => [
            'title' => __('All Students'),
            'description' => __('View the list of all students'),
        ],
    ],
];
