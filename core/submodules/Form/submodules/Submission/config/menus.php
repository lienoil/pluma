<?php

return [
    /**
     * -------------------------------------------------------------------------
     * Submissions Menus
     * -------------------------------------------------------------------------
     * Specify here the menus to appear on the sidebar.
     *
     */
    'divider_submission' => [
        'name' => 'divider_submission',
        'is_header' => true,
        'is_divider' => true,
        'parent' => 'form',
        'order' => 9,
    ],

    'view_submission' => [
        'name' => 'view-submission',
        'slug' => url(config('path.admin').'/forms/submissions'),
        'routes' => [
            'name' => 'submissions.index',
            'children' => [
                'submissions.show',
                'submissions.trash'
            ]
        ],
        'parent' => 'form',
        'order' => 11,
        'always_viewable' => false,
        'labels' => [
            'title' => __('List of Submissions'),
            'description' => __('View All Submissions'),
        ]
    ]
];
