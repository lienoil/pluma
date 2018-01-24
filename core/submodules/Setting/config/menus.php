<?php

return [
    /**
     * -------------------------------------------------------------------------
     * Setting
     * -------------------------------------------------------------------------
     *
     */
    'settings' => [
        'name' => 'settings',
        'is_parent' => true,
        'order' => 1000,
        'slug' => route('settings.general'),
        'routes' => [
            'name' => 'settings',
            'children' => [
                'settings.social',
            ]
        ],
        'always_viewable' => false,
        'icon' => 'settings',
        'labels' => [
            'title' => __('Settings'),
            'description' => __('Manage app settings')
        ],
        'children' => [
            'general-settings' => [
                'name' => 'general-settings',
                'slug' => route('settings.general'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('General'),
                    'description' => __('Manage General site settings'),
                ],
            ],

            'branding-settings' => [
                'name' => 'branding-settings',
                'slug' => route('settings.branding'),
                'always_viewable' => false,
                'icon' => 'fa-leaf',
                'labels' => [
                    'title' => __('Branding'),
                    'description' => __('Manage logos, site names, and other branding settings'),
                ],
                'children' => [
                    'branding-settings-branding' => [
                        'name' => 'branding-settings-branding',
                        'slug' => route('settings.branding'),
                        'icon' => 'fa-leaf',
                        'labels' => [
                            'title' => __('Branding'),
                            'description' => __('Manage General site settings'),
                        ],
                    ],

                    'branding-settings-social-media' => [
                        'name' => 'branding-settings-social-media',
                        'slug' => route('settings.social'),
                        'icon' => 'fa-twitter',
                        'labels' => [
                            'title' => __('Social Media'),
                            'description' => __("Manage the site's social media links"),
                        ],
                    ],
                ],
            ],
        ],
    ],
];
