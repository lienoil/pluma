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
                    'title' => __('Create Announcement'),
                    'description' => __('Create a new announcement'),
                ],
            ],
            'trashed-announcements' => [
                'name' => 'trashed-announcements',
                'order' => 3,
                'slug' => url(config('path.admin').'/announcements/trash'),
                'always_viewable' => false,
                'icon' => 'delete',
                'labels' => [
                    'title' => __('Trashed Announcements'),
                    'description' => __('View list of all announcements moved to trash'),
                ],
            ],

            'announcement-category-divider' => [
                'name' => 'announcement-category-divider',
                'is_header' => true,
                'is_divider' => true,
                'parent' => 'user',
                'order' => 9,
            ],

            'view-announcements-category' => [
                'name' => 'view-announcements-category',
                'slug' => route('announcements.categories.index'),
                'routes' => [
                    'name' => 'announcements.categories.index',
                    'children' => [
                        'announcements.categories.edit',
                    ]
                ],
                'order' => 10,
                'always_viewable' => false,
                'icon' => 'label',
                'labels' => [
                    'title' => __('Categories'),
                    'description' => __('View the list of all categories'),
                ],
            ],
        ],
    ],
];
