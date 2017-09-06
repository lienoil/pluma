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
                'slug' => url(config('path.admin').'/library'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('All Library'),
                    'description' => __('View the list of all collections in library'),
                ],
            ],
            'create-library' => [
                'name' => 'create-library',
                'order' => 2,
                'slug' => url(config('path.admin').'/library/create'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Create Library'),
                    'description' => __('Create a Library'),
                ],
            ],
            'trashed-library' => [
                'name' => 'trashed-library',
                'order' => 3,
                'slug' => url(config('path.admin').'/library/trashed'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Trashed Library'),
                    'description' => __('View list of all collections in library moved to trash'),
                ],
            ],
        ],
    ],
];
