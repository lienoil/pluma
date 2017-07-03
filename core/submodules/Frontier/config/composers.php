<?php

return [
    ['appears' => ['Frontier::partials.sidebar', 'Single::index'], 'class' => Frontier\Composers\NavigationViewComposer::class],
    ['appears' => ['*'], 'class' => Frontier\Composers\PageViewComposer::class],
];
