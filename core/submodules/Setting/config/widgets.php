<?php

return [
    'enabled' => [

        'system-corner' => [
            'name' => __("System Corner"),
            'description' => __("A general overview of the system."),
            'location' => 'dashboard.2.12',
            'code' => 'system-corner',
            'icon' => 'settings_applications',
            'view' => 'Setting::widgets.system-corner',
            'backdrop' => assets('frontier/images/placeholder/sql.jpg'),
        ],

    ],
];
