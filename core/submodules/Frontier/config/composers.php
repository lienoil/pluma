<?php

return [
    [
        'appears' => [
            'Theme::layouts.admin',
            'Theme::settings.*',
            'Theme::partials.sidemenu',
            'Theme::partials.settingsbar',
            'Setting::partials.settingsbar',
            'Setting::settings.*',
        ],
        'class' => \Frontier\Composers\NavigationViewComposer::class
    ],
    [
        'appears' => [
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
    [
        'appears' => [
            'Theme::partials.sidemenu',
        ],
        'class' => \Frontier\Composers\SidemenuComposer::class
    ],

];
