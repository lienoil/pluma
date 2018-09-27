<?php
/**
 *------------------------------------------------------------------------------
 * Permissions Array
 *------------------------------------------------------------------------------
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
     *--------------------------------------------------------------------------
     * Profile Permissions
     *--------------------------------------------------------------------------
     *
     */
    'view-profile' => [
        'name' =>  'view-profile',
        'code' => 'profile.index',
        'description' => 'Ability to view list of profiles',
        'group' => 'profile',
    ],
    'show-profile' => [
        'name' => 'show-profile',
        'code' => 'profile.show',
        'description' => 'Ability to show a single profile',
        'group' => 'profile',
    ],
    'store-profile' => [
        'name' => 'store-profile',
        'code' => 'profile.store',
        'description' => 'Ability to save the profile',
        'group' => 'profile',
    ],
    'edit-profile' => [
        'name' => 'edit-profile',
        'code' => 'profile.edit',
        'description' => 'Ability to show the form to edit profile',
        'group' => 'profile',
    ],
    'update-profile' => [
        'name' => 'update-profile',
        'code' => 'profile.update',
        'description' => 'Ability to update the profile',
        'group' => 'profile',
    ],

    /**
     *--------------------------------------------------------------------------
     * Credentials Permissions
     *--------------------------------------------------------------------------
     *
     */
    'view-credential' => [
        'name' => 'view-credential',
        'code' => 'credentials.index',
        'description' => 'Ability to view list of credentials',
        'group' => 'profile',
    ],
    'show-credential' => [
        'name' => 'show-credential',
        'code' => 'credentials.show',
        'description' => 'Ability to show a single credential',
        'group' => 'profile',
    ],
    'store-credential' => [
        'name' => 'store-credential',
        'code' => 'credentials.store',
        'description' => 'Ability to save the credential',
        'group' => 'profile',
    ],
    'edit-credential' => [
        'name' => 'edit-credential',
        'code' => 'credentials.edit',
        'description' => 'Ability to show the form to edit credential',
        'group' => 'profile',
    ],
    'update-credential' => [
        'name' => 'update-credential',
        'code' => 'credentials.update',
        'description' => 'Ability to update the credential',
        'group' => 'profile',
    ],
];
