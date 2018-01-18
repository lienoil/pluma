<?php

return [
	'enabled' => [
		'glance' => [
			'name' => __('At A Glance'),
          	'description' => __("Some analytics to analyze."),
          	'code' => 'glance',
          	'icon' => 'fa-tachometer',
          	'view' => 'Dashboard::widgets.glance',
          	'backdrop' => assets('frontier/images/placeholder/red2.jpg'),
		],
	],
];
