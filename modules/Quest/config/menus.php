<?php

return [
    /**
     *--------------------------------------------------------------------------
     * Quests Menus
     *--------------------------------------------------------------------------
     * Specify here the menus to appear on the sidebar.
     *
     */
    'quest' => [
        'name' => 'quest',
        'order' => 51,
        'slug' => route('quests.index'),
        'always_viewable' => false,
        'icon' => '',
        'labels' => [
            'title' => __('Quests'),
            'description' => __('Manage quests'),
        ],
        'children' => [
            'view-quest' => [
                'name' => 'view-quest',
                'order' => 1,
                'slug' => route('quests.index'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('All Quests'),
                    'description' => __('View the list of all quests'),
                ],
            ],
            'create-quest' => [
                'name' => 'create-quest',
                'order' => 2,
                'slug' => route('quests.create'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Create Quest'),
                    'description' => __('Create a Quest'),
                ],
            ],
            // 'trash-quest' => [
            //     'name' => 'trash-quest',
            //     'order' => 3,
            //     'slug' => route('quests.trash'),
            //     'always_viewable' => false,
            //     'labels' => [
            //         'title' => __('Trashed Quests'),
            //         'description' => __('View list of all quests moved to trash'),
            //     ],
            // ],
        ],
    ],
];
