<?php

use Frontier\Composers\ApplicationViewComposer;
use Frontier\Composers\ClientSideVariableViewComposer;
use Frontier\Composers\SidebarComposer;
use Frontier\Support\Breadcrumbs\Composers\BreadcrumbComposer;

return [
    [
        'appears' => [
            'Theme::layouts.admin',
            'Theme::partials.breadrumbs',
        ],
        'class' => BreadcrumbComposer::class
    ],
    [
        'appears' => [
            'Theme::partials.sidebar',
        ],
        'class' => SidebarComposer::class
    ],
    [
        'appears' => [
            '*',
        ],
        'class' => ApplicationViewComposer::class
    ],
    [
        'appears' => [
            '*',
            'Theme::partials.header',
        ],
        'class' => ClientSideVariableViewComposer::class
    ],
];
