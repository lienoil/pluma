<?php
/**
 * -----------------------------------------------------------------------------
 * Permissions Array
 * -----------------------------------------------------------------------------
 *
 * Here we define our permissions that you can attach to roles.
 *
 * These permissions corresponds to a counterpart
 * route (found in <this module>/routes/<route-files>.php).
 * All permissionable routes should have a `name` (e.g. 'roles.store')
 * for the role authentication middleware to work.
 *
 */
return [
    /**
     * Quest Permissions
     *
     */
    'general-settings' => [
        'name' =>  'settings.general',
        'code' => 'general-settings',
        'description' => 'Ability to view list of general settings',
        'group' => 'setting',
    ],
    'profile-settings' => [
        'name' =>  'settings.profile',
        'code' => 'profile-settings',
        'description' => 'Ability to view list of profile settings',
        'group' => ['setting', 'profile'],
    ],
    'themes-settings' => [
        'name' =>  'settings.themes',
        'code' => 'themes-settings',
        'description' => 'Ability to view list of themes settings',
        'group' => 'setting',
    ],
];
