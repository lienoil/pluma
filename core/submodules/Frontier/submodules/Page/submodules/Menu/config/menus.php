<?php

return [
    /**
     * -------------------------------------------------------------------------
     * Menus Menus
     * -------------------------------------------------------------------------
     * Specify here the menus to appear on the sidebar.
     *
     */
    'divider-page-menu' => [
        'name' => 'divider-page-menu',
        'is_header' => true,
        'is_divider' => true,
        'parent' => 'page',
        'order' => 50,
    ],

    'view-menu' => [
        'name' => 'view-menu',
        'order' => 51,
        'slug' => route('menus.index'),
        'routes' => [
            'name' => 'menus.index',
            'children' => [
                'menus.create',
                'menus.edit',
                'menus.show',
                'menus.trash',
            ]
        ],
        'always_viewable' => false,
        'icon' => 'menu',
        'parent' => 'page',
        'labels' => [
            'title' => __('Menus'),
            'description' => __('Manage public menus'),
        ],
    ],
];
