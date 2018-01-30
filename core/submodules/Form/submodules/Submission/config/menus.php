<?php

return [
    /**
     * -------------------------------------------------------------------------
     * Submissions Menus
     * -------------------------------------------------------------------------
     * Specify here the menus to appear on the sidebar.
     *
     */
    'submission' => [
        'name' => 'submission',
        'order' => 51,
        'slug' => route('submissions.index'),
        'always_viewable' => false,
        'icon' => '',
        'labels' => [
            'title' => __('Submissions'),
            'description' => __('Manage submissions'),
        ],
        'children' => [
            'view-submission' => [
                'name' => 'view-submission',
                'order' => 1,
                'slug' => route('submissions.index'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('All Submissions'),
                    'description' => __('View the list of all submissions'),
                ],
            ],
            'create-submission' => [
                'name' => 'create-submission',
                'order' => 2,
                'slug' => route('submissions.create'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Create Submission'),
                    'description' => __('Create a Submission'),
                ],
            ],
            // 'trash-submission' => [
            //     'name' => 'trash-submission',
            //     'order' => 3,
            //     'slug' => route('submissions.trash'),
            //     'always_viewable' => false,
            //     'labels' => [
            //         'title' => __('Trashed Submissions'),
            //         'description' => __('View list of all submissions moved to trash'),
            //     ],
            // ],
        ],
    ],
];
