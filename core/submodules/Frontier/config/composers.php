<?php

return [
    ['appears' => ['Frontier::layouts.admin'], 'class' => Frontier\Composers\NavigationViewComposer::class],
    ['appears' => ['*'], 'class' => Frontier\Composers\PageViewComposer::class],
];
