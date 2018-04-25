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
     * User Permissions
     *
     */
    'view-user' => [
        'name' =>  'users.index',
        'code' => 'view-user',
        'description' => 'Ability to view list of users',
        'group' => 'user',
    ],
    'show-user' => [
        'name' => 'users.show',
        'code' => 'show-user',
        'description' => 'Ability to show a single user',
        'group' => 'user',
    ],
    'create-user' => [
        'name' => 'users.create',
        'code' => 'create-user',
        'description' => 'Ability to show the form to create user',
        'group' => 'user',
    ],
    'store-user' => [
        'name' => 'users.store',
        'code' => 'store-user',
        'description' => 'Ability to save the user',
        'group' => 'user',
    ],
    'edit-user' => [
        'name' => 'users.edit',
        'code' => 'edit-user',
        'description' => 'Ability to show the form to edit user',
        'group' => 'user',
    ],
    'update-user' => [
        'name' => 'users.update',
        'code' => 'update-user',
        'description' => 'Ability to update the user',
        'group' => 'user',
    ],
    'destroy-user' => [
        'name' =>  'users.destroy',
        'code' => 'destroy-user',
        'description' => 'Ability to move the user to trash',
        'group' => 'user',
    ],
    'delete-user' => [
        'name' =>  'users.delete',
        'code' => 'delete-user',
        'description' => 'Ability to permanently delete the user',
        'group' => 'user',
    ],
    'trash-user' => [
        'name' =>  'users.trash',
        'code' => 'trash-user',
        'description' => 'Ability to view the list of all trashed user',
        'group' => 'user',
    ],
    'restore-user' => [
        'name' => 'users.restore',
        'code' => 'restore-user',
        'description' => 'Ability to restore the user',
        'group' => 'user',
    ],

    // Password
    'change-password' => [
        'name' =>  'users.password.change',
        'code' => 'change-password',
        'description' => 'Ability to change the user password without using the old password',
        'group' => 'user',
    ],

    // Many
    'destroy-many-user' => [
        'name' =>  'users.many.destroy',
        'code' => 'destroy-many-user',
        'description' => 'Ability to destroy many users',
        'group' => 'user',
    ],
    'delete-many-user' => [
        'name' =>  'users.many.delete',
        'code' => 'delete-many-user',
        'description' => 'Ability to permanently delete many users',
        'group' => 'user',
    ],
    'restore-many-user' => [
        'name' => 'users.many.restore',
        'code' => 'restore-many-user',
        'description' => 'Ability to restore many users',
        'group' => 'user',
    ],

    //
];
