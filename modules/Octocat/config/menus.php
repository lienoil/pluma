<?php

return [
    /**
     *--------------------------------------------------------------------------
     * Octocats Menus
     *--------------------------------------------------------------------------
     * Specify here the menus to appear on the sidebar.
     *
     */
    'octocat' => [
        'name' => 'octocat',
        'order' => 51,
        'slug' => route('octocats.index'),
        'always_viewable' => false,
        'icon' => '',
        'labels' => [
            'title' => __('Octocats'),
            'description' => __('Manage octocats'),
        ],
        'children' => [
            'view-octocat' => [
                'name' => 'view-octocat',
                'order' => 1,
                'slug' => route('octocats.index'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('All Octocats'),
                    'description' => __('View the list of all octocats'),
                ],
            ],
            'create-octocat' => [
                'name' => 'create-octocat',
                'order' => 2,
                'slug' => route('octocats.create'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Create Octocat'),
                    'description' => __('Create a Octocat'),
                ],
            ],
            // 'trash-octocat' => [
            //     'name' => 'trash-octocat',
            //     'order' => 3,
            //     'slug' => route('octocats.trash'),
            //     'always_viewable' => false,
            //     'labels' => [
            //         'title' => __('Trashed Octocats'),
            //         'description' => __('View list of all octocats moved to trash'),
            //     ],
            // ],
        ],
    ],
];
