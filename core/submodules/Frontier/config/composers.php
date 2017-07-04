<?php

return [
    ['appears' => ['Frontier::partials.sidebar', 'Single::layouts.*'], 'class' => Frontier\Composers\NavigationViewComposer::class],
    ['appears' => ['*'], 'class' => Frontier\Composers\PageViewComposer::class],
];
