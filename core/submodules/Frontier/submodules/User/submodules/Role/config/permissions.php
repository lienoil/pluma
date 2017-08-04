<?php
/**
 * --------------------------------------
 * Permissions Array
 * --------------------------------------
 *
 * Here we define our permissions that you can attach to roles.
 *
 * These permissions corresponds to a counterpart
 * route (found in <this module>/routes/<route-files>.php).
 * All permissionable routes should have a `name` (e.g. 'roles.store')
 * for the CheckRole to work.
 *
 * These routes must have the middleware 'roles' for this to work.
 *
 */
return [
    /**
     * Role Permissions
     *
     */
    'view-role' => [
        'name' =>  'roles.index',
        'code' => 'view-role',
        'description' => 'View roles',
    ],
    'show-role' => [
        'name' => 'roles.show',
        'code' => 'show-role',
        'description' => 'Show a role',
    ],
    'create-role' => [
        'name' => 'roles.create',
        'code' => 'create-role',
        'description' => 'Show role form',
    ],
    'store-role' => [
        'name' => 'roles.store',
        'code' => 'store-role',
        'description' => 'Store the role',
    ],
    'edit-role' => [
        'name' => 'roles.edit',
        'code' => 'edit-role',
        'description' => 'Edit the role',
    ],
    'update-role' => [
        'name' => 'roles.update',
        'code' => 'update-role',
        'description' => 'Update the role',
    ],
    'destroy-role' => [
        'name' =>  'roles.destroy',
        'code' => 'destroy-role',
        'description' => 'Destroy the role',
    ],
    'trash-role' => [
        'name' =>  'roles.trash',
        'code' => 'trash-role',
        'description' => 'Trash the role',
    ],
    'restore-role' => [
        'name' => 'roles.restore',
        'code' => 'restore-role',
        'description' => 'Restore the role',
    ],
];
