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
     * Profile Permissions
     *
     */
    'view-profile' => [
        'name' =>  'profiles.index',
        'code' => 'view-profile',
        'description' => 'Ability to view list of profiles',
        'group' => 'profile',
    ],
    'show-profile' => [
        'name' => 'profiles.show',
        'code' => 'show-profile',
        'description' => 'Ability to show a single profile',
        'group' => 'profile',
    ],
    'store-profile' => [
        'name' => 'profiles.store',
        'code' => 'store-profile',
        'description' => 'Ability to save the profile',
        'group' => 'profile',
    ],
    'edit-profile' => [
        'name' => 'profiles.edit',
        'code' => 'edit-profile',
        'description' => 'Ability to show the form to edit profile',
        'group' => 'profile',
    ],
    'update-profile' => [
        'name' => 'profiles.update',
        'code' => 'update-profile',
        'description' => 'Ability to update the profile',
        'group' => 'profile',
    ],
];
