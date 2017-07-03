<?php

return [
    'page' => [
        'name' => 'page',
        'is_parent' => true,
        'order' => 2,
        'slug' => 'pages',
        'always_viewable' => false,
        'icon' => 'insert_drive_file',
        // 'icon' => [
        //     'class' => 'fa fa-file',
        //     'tag' => 'i',
        //     'content' => '&nbsp;',
        // ], // or can be a html string e.g. <span class="fa fa-edit">&nbsp;</span>
        'labels' => [
            'title' => 'Pages',
        ],
    ],

    'all-page' => [
        'name' => 'all-page',
        'parent' => 'page',
        'order' => 2,
        'slug' => 'all',
        'always_viewable' => false,
        // 'icon' => 'web',
        'labels' => [
            'title' => 'All Pages',
        ],
    ],

    'create-page' => [
        'name' => 'create-page',
        'parent' => 'page',
        'order' => 2,
        'slug' => 'all',
        'always_viewable' => false,
        // 'icon' => '<span class="material-icon">insert drive file</span>',
        'labels' => [
            'title' => 'Create Page',
        ],
    ],
];
