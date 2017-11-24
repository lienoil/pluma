<?php

return [
    ['appears' => [
        'Template::templates.*',
        'Theme::templates.*',
        'Theme::layouts.public',
        'Template::layouts.public',
    ],
    'class' => \Page\Composers\MainMenuViewComposer::class],
];
