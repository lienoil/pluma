<?php

return [
    'dashboard' => [
        'name' => 'dashboard',
        'slug' => 'dashboard',
        'is_parent' => true,
        'always_viewable' => true,
        'order' => 1,
        'icon' => '<span class="material-icon">dashboard</span>',
        // 'icon' => [
        //     'class' => 'fa fa-file',
        //     'tag' => 'i',
        //     'content' => '&nbsp;',
        // ], // or can be a html string e.g. <span class="fa fa-edit">&nbsp;</span>
        'labels' => [
            'singular' => 'Page',
            'plural' => 'Pages',
        ],
    ],
];
