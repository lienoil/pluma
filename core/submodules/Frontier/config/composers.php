<?php

return [
    [
        'appears' => [
            'Frontier::layouts.admin',
            'Theme::layouts.admin',
            'Theme::settings.*',
            'Setting::partials.settingsbar',
            'Setting::settings.*',
        ],
        'class' => \Frontier\Composers\NavigationViewComposer::class
    ],
    [
        'appears' => [
            '*'
        ],
        'class' => \Frontier\Composers\ApplicationViewComposer::class
    ],
];
