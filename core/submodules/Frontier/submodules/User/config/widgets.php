<?php

return [

    'enabled' => [

        'user-activity' => [
            'name' => __('User Activities'),
            'description' => __("View the user's activities."),
            'location' => 'dashboard.2.2',
            'code' => 'user-activity',
            'icon' => 'multiline_chart',
            'view' => 'User::widgets.activity',
        ],

    ],
];
