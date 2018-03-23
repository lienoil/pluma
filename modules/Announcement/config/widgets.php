<?php

return [
    'enabled' => [

        'announcements' => [
            'name' => __("Announcements"),
            'description' => __("A general overview of the system."),
            'location' => 'dashboard.2.3',
            'code' => 'announcements',
            'icon' => 'fa-bullhorn',
            'view' => 'Announcement::widgets.announcements',
            'backdrop' => assets('frontier/images/placeholder/sql.jpg'),
        ],

    ],
];
