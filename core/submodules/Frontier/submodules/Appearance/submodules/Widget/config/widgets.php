<?php

return [
    'enabled' => [

        'test' => [
        	'name' => __('Laboratory Widget'),
            'description' => __("A test widget intended to showcase widgets."),
            'location' => 'test.1.12',
            'code' => 'test',
            'icon' => 'fa-flask',
            'view' => 'Widget::widgets.test',
            'backdrop' => assets('frontier/images/placeholder/red2.jpg'),
        ],

        'user-activity' => [
            'name' => __('User Activities'),
            'description' => __("Reads user's activities."),
            'location' => 'test.1.12',
            'code' => 'activity',
            'icon' => 'multiline_chart',
            'view' => 'Widget::widgets.activity',
        ],
    ],
];
