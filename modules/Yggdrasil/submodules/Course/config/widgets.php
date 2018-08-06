<?php

return [
    'enabled' => [

        'course' => [
            'name' => __("Course"),
            'description' => __("Glance of your course"),
            'location' => 'dasboard.2.12',
            'code' => 'course',
            'icon' => 'school',
            'view' => 'Course::widgets.course',
        ],

        'badge' => [
            'name' => __("Badge"),
            'description' => __("Glance of your badge"),
            'location' => 'dashboard.2.1',
            'code' => 'badge',
            'icon' => 'stars',
            'view' => 'Course::widgets.badge',
        ],
    ],
];
