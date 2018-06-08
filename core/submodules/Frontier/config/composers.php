<?php

return [
    [
        'appears' => [
            'Frontier::layouts.admin',
            'Theme::layouts.admin',
            'Theme::settings.*',
            'Theme::partials.settingsbar',
            'Setting::partials.settingsbar',
            'Setting::settings.*',
        ],
        'class' => \Frontier\Composers\NavigationViewComposer::class
    ],
    [
        'appears' => [
            'Theme::layouts.admin',
            'Theme::partials.sidebar',
        ],
        'class' => \Frontier\Composers\SidebarComposer::class
    ],
    [
        'appears' => [
            '*',
        ],
        'class' => \Frontier\Composers\ApplicationViewComposer::class
    ],
    [
        'appears' => [
            '*',
            'Theme::partials.header',
        ],
        'class' => \Frontier\Composers\ClientSideVariableViewComposer::class
    ],
];
