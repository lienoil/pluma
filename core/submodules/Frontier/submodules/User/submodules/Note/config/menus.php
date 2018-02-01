<?php

return [
    /**
     *--------------------------------------------------------------------------
     * Notes Menus
     *--------------------------------------------------------------------------
     * Specify here the menus to appear on the sidebar.
     *
     */
    'show-note' => [
        'name' => 'show-note',
        'order' => 55,
        'slug' => route('notes.show', user()->handlename),
        'route' => 'notes.show',
        'always_viewable' => false,
        'parent' => 'profile-group',
        'icon' => 'edit',
        'labels' => [
            'title' => __('My Notes'),
            'description' => __('Manage your notes here'),
        ],
    ],
];
