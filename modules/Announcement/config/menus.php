<?php

return [
    /**
     * -------------------------------------------------------------------------
     * Announcements Menus
     * -------------------------------------------------------------------------
     * Specify here the menus to appear on the sidebar.
     *
     */
    'announcement' => [
        'name' => 'announcement',
        'order' => 51,
        'slug' => url(config('path.admin').'/announcements'),
        'always_viewable' => false,
        'icon' => 'announcement',
        'labels' => [
            'title' => __('Announcements'),
            'description' => __('Manage announcements'),
        ],
        'children' => [
            'view-announcements' => [
                'name' => 'view-announcements',
                'order' => 1,
                'slug' => url(config('path.admin').'/announcements'),
                'always_viewable' => false,
                'routes' => [
                    'name' => 'announcements.index',
                    'children' => [
                        'announcements.edit',
                        'announcements.show',
                    ]
                ],
                'labels' => [
                    'title' => __('All Announcements'),
                    'description' => __('View the list of all announcements'),
                ],
            ],
            'create-announcement' => [
                'name' => 'create-announcement',
                'order' => 2,
                'slug' => url(config('path.admin').'/announcements/create'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Create'),
                    'description' => __('Create a Announcement'),
                ],
            ],
            'trashed-announcements' => [
                'name' => 'trashed-announcements',
                'order' => 3,
                'slug' => url(config('path.admin').'/announcements/trash'),
                'always_viewable' => false,
                'icon' => 'delete',
                'labels' => [
                    'title' => __('Trashed'),
                    'description' => __('View list of all announcements moved to trash'),
                ],
            ],
        ],
    ],
];
