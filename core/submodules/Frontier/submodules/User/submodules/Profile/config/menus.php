<?php

return [
    /**
     * -------------------------------------------------------------------------
     * Avatar Menus
     * -------------------------------------------------------------------------
     *
     *
     */
    'avatar' => [
        'is_avatar' => true,
        'is_header' => false,
        'order' => 0,
        'name' => 'avatar',
        'always_viewable' => true,
        'routes' => [
            'name' => 'profile.index',
            'children' => [
                'profile.show',
            ]
        ],
        'labels' => [
            'title' => __('Profile'),
            'description' => __('Manage profile'),
        ],
        'children' => [
            /**
             * -----------------------------------------------------------------
             * Profiles Menus
             * -----------------------------------------------------------------
             * Specify here the menus to appear on the sidebar.
             *
             */
            'show-profile' => [
                'name' => 'show-profile',
                'order' => 1,
                'slug' => route('profile.show', user()->handlename),
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

            /**
             * -----------------------------------------------------------------
             * Logout
             * -----------------------------------------------------------------
             * Logout
             *
             */
            'logout' => [
                'name' => 'logout',
                'order' => 2,
                'slug' => route('logout.logout'),
                'always_viewable' => true,
                'icon' => 'exit_to_app',
                'routes' => [
                    'name' => 'logout.logout',
                ],
                'labels' => [
                    'title' => __('Logout'),
                    'description' => __('Signout from the application'),
                ],
            ],
        ],
    ],

];
