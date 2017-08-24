<?php

return [
    /**
     * -------------------------------------------------------------------------
     * Profiles Menus
     * -------------------------------------------------------------------------
     * Specify here the menus to appear on the sidebar.
     *
     */
    'show-profile' => [
        'name' => 'show-profile',
        'order' => 1,
        'slug' => url(config('path.admin').'/profile/'.user()->handlename),
        'always_viewable' => true,
        'icon' => 'account_circle',
        'routes' => [
            'name' => 'profile.show',
            'children' => [
                'profile.show',
            ]
        ],
        'labels' => [
            'title' => __('Profile'),
            'description' => __('Manage profile'),
        ],
    ],
];
