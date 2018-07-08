<?php

return [
    /**
     *--------------------------------------------------------------------------
     * Blogs Menus
     *--------------------------------------------------------------------------
     *
     * Specify here the menus to appear on the sidebar.
     *
     */
    'blog' => [
        'name' => 'blog',
        'order' => 51,
        'slug' => route('blogs.index'),
        'always_viewable' => false,
        'icon' => '',
        'labels' => [
            'title' => __('Blogs'),
            'description' => __('Manage blogs'),
        ],
        'children' => [
            'view-blogs' => [
                'name' => 'view-blogs',
                'order' => 1,
                'slug' => route('blogs.index'),
                'code' => 'blogs.index',
                'always_viewable' => false,
                'labels' => [
                    'title' => __('All Blogs'),
                    'description' => __('View the list of all blogs'),
                ],
            ],
            'create-blog' => [
                'name' => 'create-blog',
                'order' => 2,
                'slug' => route('blogs.create'),
                'code' => 'blogs.create',
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Create Blog'),
                    'description' => __('Create a Blog'),
                ],
            ],
            'trashed-blog' => [
                'name' => 'trashed-blog',
                'order' => 3,
                'slug' => route('blogs.trashed'),
                'code' => 'blogs.trashed',
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Trashed Blogs'),
                    'description' => __('View list of all blogs moved to trash'),
                ],
            ],
        ],
    ],
];
