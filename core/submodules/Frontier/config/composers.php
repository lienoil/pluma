<?php

return [
    ['appears' => ['Frontier::layouts.admin', 'Theme::layouts.admin', 'Theme::layouts.course'], 'class' => Frontier\Composers\NavigationViewComposer::class],
    ['appears' => ['*'], 'class' => Frontier\Composers\PageViewComposer::class],
];
