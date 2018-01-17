<?php

return [
    'enabled' => [

        'test' => [
        	'name' => __('Laboratory Widget'),
            'description' => __("A test widget intended to showcase widgets."),
            'code' => 'test',
            'icon' => 'fa-flask',
            'view' => 'Widget::widgets.test',
        ],

        'user-activity' => [
            'name' => __('User Activities'),
            'description' => __("Reads user's activities."),
            'code' => 'activity',
            'icon' => 'multiline_chart',
            'view' => 'Widget::widgets.activity',
        ],
    ],
];
