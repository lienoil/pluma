<?php

return [
    /**
     *--------------------------------------------------------------------------
     * Tasks Menus
     *--------------------------------------------------------------------------
     *
     * Specify here the menus to appear on the sidebar.
     *
     */
    'task' => [
        'name' => 'task',
        'order' => 51,
        'slug' => route('tasks.index'),
        'always_viewable' => false,
        'icon' => '',
        'labels' => [
            'title' => __('Tasks'),
            'description' => __('Manage tasks'),
        ],
        'children' => [
            'view-task' => [
                'name' => 'view-task',
                'order' => 1,
                'slug' => route('tasks.index'),
                'code' => 'tasks.index',
                'always_viewable' => false,
                'labels' => [
                    'title' => __('All Tasks'),
                    'description' => __('View the list of all tasks'),
                ],
            ],
            'create-task' => [
                'name' => 'create-task',
                'order' => 2,
                'slug' => route('tasks.create'),
                'code' => 'tasks.create',
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Create Task'),
                    'description' => __('Create a Task'),
                ],
            ],
            'trashed-task' => [
                'name' => 'trashed-task',
                'order' => 3,
                'slug' => route('tasks.trashed'),
                'code' => 'tasks.trashed',
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Trashed Tasks'),
                    'description' => __('View list of all tasks moved to trash'),
                ],
            ],
        ],
    ],
];
