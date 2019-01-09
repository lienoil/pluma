<?php

return [
    /**
     *--------------------------------------------------------------------------
     * Comments Settings Menus
     *--------------------------------------------------------------------------
     *
     * Specify here the menus to appear on the sidebar.
     *
     */

    'commenting-settings' => [
        'name' => 'commenting-settings',
        'slug' => route('settings:commenting.index'),
        'code' => 'settings:commenting.index',
        'parent' => 'settings',
        'icon' => 'mdi mdi-comment-text-multiple-outline',
        'order' => 888,
        'labels' => [
            'title' => __('Commenting'),
            'description' => __('Manage the way users comments on you pages.'),
        ],
    ],
];
