<?php

return [
    [
        'appears' => [
            'Frontier::layouts.admin',
            'Theme::layouts.admin',
            'Setting::partials.settingsbar',
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
