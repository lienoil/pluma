<?php

return [
    'enabled' => [

        'test' => [
        	'name' => __('Test Widget'),
            'code' => 'test',
            'icon' => 'fa-flask',
        	'view' => 'Widget::widgets.test',
        ],

        'activity' => [
            'name' => __('Activity'),
            'code' => 'activity',
            'icon' => 'multiline_chart',
            'view' => 'Widget::widgets.activity',
        ],
    ],
];
