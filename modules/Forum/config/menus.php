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
        'order' => 60,
        'slug' => route('forums.index'),
        'always_viewable' => false,
        'icon' => 'chat_bubble_outline',
        'labels' => [
            'title' => __('Forum'),
            'description' => __('Expand to know more.'),
        ],
        'children' => [
            'view-forum' => [
                'name' => 'view-forum',
                'order' => 1,
                'slug' => route('forums.index'),
                'always_viewable' => false,
                'routes' => [
                    'name' => 'forums.index',
                    'children' => [
                        'forums.edit',
                        'forums.show',
                    ]
                ],
                'labels' => [
                    'title' => __('All Threads'),
                    'description' => __('View the list of all threads in the forum'),
                ],
            ],
            'create-forum' => [
                'name' => 'create-forum',
                'order' => 2,
                'slug' => route('forums.create'),
                'icon' => 'fa-question',
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Ask a Question'),
                    'description' => __('Post to the Forum and get feedback from the community'),
                ],
            ],
            'trashed-forum' => [
                'name' => 'trashed-forum',
                'order' => 3,
                'slug' => route('forums.trashed'),
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
