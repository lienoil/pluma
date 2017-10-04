<?php

return [
    /**
     * -------------------------------------------------------------------------
     * Quests Menus
     * -------------------------------------------------------------------------
     * Specify here the menus to appear on the sidebar.
     *
     */
    'quest' => [
        'name' => 'quest',
        'order' => 51,
        'slug' => url(config('path.admin').'/quests'),
        'always_viewable' => false,
        'icon' => 'fa-edit',
        'labels' => [
            'title' => __('Quests'),
            'description' => __('Manage quests'),
        ],
        'children' => [
            'view-quest' => [
                'name' => 'view-quest',
                'order' => 1,
                'slug' => url(config('path.admin').'/quests'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('All Quests'),
                    'description' => __('View the list of all quests'),
                ],
            ],
            'create-quest' => [
                'name' => 'create-quest',
                'order' => 2,
                'slug' => url(config('path.admin').'/quests/create'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Create Quest'),
                    'description' => __('Create a Quest'),
                ],
            ],
            'trashed-quest' => [
                'name' => 'trashed-quest',
                'order' => 3,
                'slug' => url(config('path.admin').'/quests/trashed'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Trashed Quests'),
                    'description' => __('View list of all quests moved to trash'),
                ],
            ],
        ],
    ],
];
