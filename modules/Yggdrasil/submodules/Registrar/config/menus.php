<?php

return [
    /**
     * -------------------------------------------------------------------------
     * Registrar Menus
     * -------------------------------------------------------------------------
     * Specify here the menus to appear on the sidebar.
     *
     */
    'divider-for-course-registrar' => [
        'name' => 'divider-for-course-registrar',
        'is_header' => true,
        'is_divider' => true,
        'parent' => 'course',
        'order' => 9,
    ],

    'view-registrar' => [
        'name' => 'view-registrar',
        'slug' => url(config('path.admin').'/courses/registrar'),
        'routes' => [
            'name' => 'courses.index',
            'children' => [
                'registrar.create',
                'registrar.edit',
                'registrar.show',
                'registrar.trash',
            ]
        ],
        'parent' => 'course',
        'order' => 10,
        'always_viewable' => false,
        'icon' => 'fa-graduation-cap',
        'labels' => [
            'title' => __('Registrar'),
            'description' => __('Manage Course accounts'),
        ],
    ],
];
