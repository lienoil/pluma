<?php

return [
    /**
     * -------------------------------------------------------------------------
     * Timesheets Menus
     * -------------------------------------------------------------------------
     * Specify here the menus to appear on the sidebar.
     *
     */
    'timesheet' => [
        'name' => 'timesheet',
        'order' => 200,
        'slug' => url(config('path.admin').'/timesheets'),
        'always_viewable' => false,
        'icon' => 'fa-clock-o',
        'labels' => [
            'title' => __('Timesheets'),
            'description' => __('Manage timesheets'),
        ],
        'children' => [
            'show-timesheets' => [
                'name' => 'show-timesheets',
                'order' => 1,
                'slug' => route('timesheets.show', user()->username),
                'always_viewable' => true,
                'routes' => [
                    'name' => 'timesheets.my.index',
                    'children' => [
                        'timesheets.my.show',
                    ]
                ],
                'labels' => [
                    'title' => __('My Timesheets'),
                    'description' => __('View your timesheets'),
                ],
            ],

            'view-timesheet' => [
                'name' => 'view-timesheet',
                'order' => 1,
                'slug' => url(config('path.admin').'/timesheets'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('All Timesheets'),
                    'description' => __('View the list of all timesheets'),
                ],
            ],
            'view-timesheet' => [
                'name' => 'view-timesheet',
                'order' => 1,
                'slug' => url(config('path.admin').'/timesheets'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('All Timesheets'),
                    'description' => __('View the list of all timesheets'),
                ],
            ],
            'create-timesheet' => [
                'name' => 'create-timesheet',
                'order' => 2,
                'slug' => url(config('path.admin').'/timesheets/create'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Create Timesheet'),
                    'description' => __('Create a Timesheet'),
                ],
            ],
            'trashed-timesheet' => [
                'name' => 'trashed-timesheet',
                'order' => 3,
                'slug' => url(config('path.admin').'/timesheets/trashed'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Trashed Timesheets'),
                    'description' => __('View list of all timesheets moved to trash'),
                ],
            ],
        ],
    ],
];
