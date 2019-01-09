<?php

return [
    'management' => [
        'name' => 'management',
        'is_header' => true,
        'always_viewable' => false,
        'permission' => 'settings:general.index',
        'order' => 499,
        'class' => 'separator',
        'markup' => 'span',
        'text' => __('Management'),
    ],
];
