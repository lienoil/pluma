<?php

return [
    /**
     *--------------------------------------------------------------------------
     * Submissions Menus
     *--------------------------------------------------------------------------
     * Specify here the menus to appear on the sidebar.
     *
     */
    'view-submission' => [
        'name' => 'view-submission',
        'slug' => url(config('path.admin').'/forms/submissions'),
        'routes' => [
            'name' => 'submissions.index',
            'children' => [
                'forms.submissions.create',
                'forms.submissions.edit',
                'forms.submissions.show',
                'forms.submissions.trash',
            ]
        ],
        'parent' => 'form',
        'order' => 10,
        'always_viewable' => false,
        'icon' => 'text_format',
        'labels' => [
            'title' => __('List of Submissions'),
            'description' => __('View the list of all submissions'),
        ],
    ],
];
