<?php

return [
    /**
     * -------------------------------------------------------------------------
     * Library Menus
     * -------------------------------------------------------------------------
     * Specify here the menus to appear on the sidebar.
     *
     */
    'library' => [
        'name' => 'library',
        'order' => 51,
        'slug' => url(config('path.admin').'/library'),
        'always_viewable' => false,
        'icon' => 'fa-institution',
        'labels' => [
            'title' => __('Library'),
            'description' => __('Manage collections in library'),
        ],
        'children' => [
            'view-library' => [
                'name' => 'view-library',
                'order' => 1,
                'slug' => route('library.index'),
                // 'always_viewable' => false,
                'labels' => [
                    'title' => __('Library'),
                    'description' => __('View the list of all collections in library'),
                ],
            ],
            // 'create-library' => [
            //     'name' => 'create-library',
            //     'order' => 2,
            //     'slug' => url(config('path.admin').'/library/create'),
            //     'always_viewable' => false,
            //     'labels' => [
            //         'title' => __('Create Library'),
            //         'description' => __('Create a Library'),
            //     ],
            // ],
            'trashed-library' => [
                'name' => 'trashed-library',
                'order' => 3,
                'slug' => route('library.trash'),
                // 'always_viewable' => false,
                'icon' => 'archive',
                'labels' => [
                    'title' => __('Archived'),
                    'description' => __('View list of all collections in library moved to trash'),
                ],
            ],
        ],
    ],
];
