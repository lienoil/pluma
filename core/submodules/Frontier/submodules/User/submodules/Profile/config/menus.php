<?php

return [
    /**
     *--------------------------------------------------------------------------
     * Avatar Menus
     *--------------------------------------------------------------------------
     *
     */
    'avatar' => [
        'is_avatar' => true,
        'is_header' => false,
        'is_parent' => true,
        'order' => 0,
        'name' => 'avatar',
        'always_viewable' => true,
        'labels' => [
            'avatar' => user()->avatar ?? '',
            'name' => user()->fullname ?? '',
            'role' => user()->displayrole ?? '',
        ],
        'children' => [
            /**
             *------------------------------------------------------------------
             * Profiles Menus
             *------------------------------------------------------------------
             *
             * Specify here the menus to appear on the sidebar.
             *
             */
            // 'profile-group' => [
            //     'name' => 'profile-group',
            //     'slug' => route('profile.show', user()->handlename ?? ''),
            //     'is_group_link' => true,
            //     'always_viewable' => false,
            //     'icon' => 'account_circle',
            //     'labels' => [
            //         'title' => __('My Profile'),
            //         'description' => __('Manage your account.'),
            //     ],
            //     'routes' => [
            //         'name' => 'profile.show',
            //         'children' => [
            //             'profile.show',
            //             'profile.edit',
            //         ]
            //     ],
            //     'children' => [
            //         'show-profile' => [
            //             'name' => 'show-profile',
            //             'order' => 1,
            //             'slug' => route('profile.show', user()->handlename ?? ''),
            //             'route' => 'profile.show',
            //             'always_viewable' => true,
            //             'icon' => 'account_circle',
            //             'routes' => [
            //                 'name' => 'profile.show',
            //                 'children' => [
            //                     'profile.edit',
            //                     'profile.show',
            //                     'notes.show',
            //                 ]
            //             ],
            //             'labels' => [
            //                 'title' => __('My Profile'),
            //                 'description' => __('Manage profile'),
            //             ],
            //         ],
            //     ],
            // ],

            'profile-settings-group' => [
                'name' => 'profile-settings-group',
                'order' => 2,
                'slug' => route('profile.show', user()->handlename ?? ''),
                'always_viewable' => true,
                'is_group_link' => true,
                'icon' => 'account_circle',
                'labels' => [
                    'title' => __('My Profile'),
                    'description' => __('Manage profile'),
                ],
                'children' => [
                    'show-profile' => [
                        'name' => 'show-profile',
                        'order' => 1,
                        'slug' => route('profile.show', user()->handlename ?? ''),
                        'route' => 'profile.show',
                        'always_viewable' => true,
                        'icon' => 'account_circle',
                        'routes' => [
                            'name' => 'profile.show',
                            'children' => [
                                'profile.edit',
                                'profile.show',
                                'notes.show',
                            ]
                        ],
                        'labels' => [
                            'title' => __('My Profile'),
                            'description' => __('Manage profile'),
                        ],
                    ],
                    'edit-credentials' => [
                        'name' => 'edit-credentials',
                        'order' => 1,
                        'slug' => route('credentials.edit', user()->handlename ?? ''),
                        'route' => 'credentials.edit',
                        'always_viewable' => true,
                        'icon' => 'vpn_key',
                        'labels' => [
                            'title' => __('Credentials'),
                            'description' => __('Manage your account'),
                        ],
                    ],
                    'edit-email' => [
                        'name' => 'edit-email',
                        'order' => 1,
                        'slug' => route('profile.emails.edit', user()->handlename ?? ''),
                        'route' => 'profile.emails.edit',
                        'always_viewable' => true,
                        'icon' => 'mail',
                        'labels' => [
                            'title' => __('Emails'),
                            'description' => __('Manage your email preferences'),
                        ],
                    ],
                ],
            ],

            'profile-logout-divider' => [
                'name' => 'profile-logout-divider',
                'is_header' => true,
                'is_divider' => true,
                'parent' => 'profile',
                'order' => 999,
            ],

            /**
             *------------------------------------------------------------------
             * Logout
             *------------------------------------------------------------------
             *
             * Logout
             *
             */
            'logout' => [
                'name' => 'logout',
                'order' => 1000,
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
