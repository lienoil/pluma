<?php

return [
    /**
     * -------------------------------------------------------------------------
     * Forums Menus
     * -------------------------------------------------------------------------
     * Specify here the menus to appear on the sidebar.
     *
     */
    'forum' => [
        'name' => 'forum',
        'order' => 51,
        'slug' => route('forums.index'),
        'always_viewable' => false,
        'icon' => 'chat_bubble_outline',
        'labels' => [
            'title' => __('Forums'),
            'description' => __('Manage forums'),
        ],
        'children' => [
            'view-forum' => [
                'name' => 'view-forum',
                'order' => 1,
                'slug' => route('forums.index'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('All Forums'),
                    'description' => __('View the list of all forums'),
                ],
            ],
            'create-forum' => [
                'name' => 'create-forum',
                'order' => 2,
                'slug' => route('forums.create'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Create Forum'),
                    'description' => __('Create a Forum'),
                ],
            ],
            'trash-forum' => [
                'name' => 'trash-forum',
                'order' => 3,
                'slug' => route('forums.trash'),
                'always_viewable' => false,
                'icon' => 'delete',
                'labels' => [
                    'title' => __('Trashed Forums'),
                    'description' => __('View list of all forums moved to trash'),
                ],
            ],

            'divider-for-forum-category' => [
                'name' => 'divider-for-forum-category',
                'is_header' => true,
                'is_divider' => true,
                'parent' => 'forum',
                'order' => 12,
            ],

            'forum-category' => [
                'name' => 'forum-category',
                'order' => 13,
                'slug' => route('forums.categories.index'),
                'always_viewable' => false,
                'icon' => 'label',
                'labels' => [
                    'title' => __('Categories'),
                    'description' => __('View list of all forum categories'),
                ],
            ],
        ],

    ],
];
