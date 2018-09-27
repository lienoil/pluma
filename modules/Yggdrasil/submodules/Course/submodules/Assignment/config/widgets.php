<?php

return [
    'enabled' => [

        'assignments' => [
            'name' => __("Assignments"),
            'description' => __(
                "List of assignments per enrolled course."),
            'location' => 'dashboard.3.0',
            'code' => 'assignments',
            'icon' => 'file_copy',
            'view' => 'Assignment::widgets.assignments',
        ],
    ],
];
