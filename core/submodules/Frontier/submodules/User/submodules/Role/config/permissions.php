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
        'group' => 'role',
    ],
    'show-role' => [
        'name' => 'roles.show',
        'code' => 'show-role',
        'description' => 'Show a role',
        'group' => 'role',
    ],
    'create-role' => [
        'name' => 'roles.create',
        'code' => 'create-role',
        'description' => 'Show role form',
        'group' => 'role',
    ],
    'store-role' => [
        'name' => 'roles.store',
        'code' => 'store-role',
        'description' => 'Store the role',
        'group' => 'role',
    ],
    'edit-role' => [
        'name' => 'roles.edit',
        'code' => 'edit-role',
        'description' => 'Edit the role',
        'group' => 'role',
    ],
    'update-role' => [
        'name' => 'roles.update',
        'code' => 'update-role',
        'description' => 'Update the role',
        'group' => 'role',
    ],
    'destroy-role' => [
        'name' =>  'roles.destroy',
        'code' => 'destroy-role',
        'description' => 'Destroy the role',
        'group' => 'role',
    ],
    'trash-role' => [
        'name' =>  'roles.trash',
        'code' => 'trash-role',
        'description' => 'Trash the role',
        'group' => 'role',
    ],
    'restore-role' => [
        'name' => 'roles.restore',
        'code' => 'restore-role',
        'description' => 'Restore the role',
        'group' => 'role',
    ],

    /**
     * Grants Permissions
     */
    'view-grant' => [
        'name' =>  'grants.index',
        'code' => 'view-grant',
        'description' => 'View grants',
        'group' => 'grant',
    ],
    'show-grant' => [
        'name' => 'grants.show',
        'code' => 'show-grant',
        'description' => 'Show a grant',
        'group' => 'grant',
    ],
    'create-grant' => [
        'name' => 'grants.create',
        'code' => 'create-grant',
        'description' => 'Show grant form',
        'group' => 'grant',
    ],
    'store-grant' => [
        'name' => 'grants.store',
        'code' => 'store-grant',
        'description' => 'Store the grant',
        'group' => 'grant',
    ],
    'edit-grant' => [
        'name' => 'grants.edit',
        'code' => 'edit-grant',
        'description' => 'Edit the grant',
        'group' => 'grant',
    ],
    'update-grant' => [
        'name' => 'grants.update',
        'code' => 'update-grant',
        'description' => 'Update the grant',
        'group' => 'grant',
    ],
    'destroy-grant' => [
        'name' =>  'grants.destroy',
        'code' => 'destroy-grant',
        'description' => 'Destroy the grant',
        'group' => 'grant',
    ],
    'trash-grant' => [
        'name' =>  'grants.trash',
        'code' => 'trash-grant',
        'description' => 'Trash the grant',
        'group' => 'grant',
    ],
    'restore-grant' => [
        'name' => 'grants.restore',
        'code' => 'restore-grant',
        'description' => 'Restore the grant',
        'group' => 'grant',
    ],
    'refresh-grant' => [
        'name' => 'grants.refresh',
        'code' => 'refresh-grant',
        'description' => 'Refresh the grants',
        'group' => 'grant',
    ],

    /**
     * Permission Permissions
     */
    'view-permission' => [
        'name' =>  'permissions.index',
        'code' => 'view-permission',
        'description' => 'View permissions',
        'group' => 'permission',
    ],
    'show-permission' => [
        'name' => 'permissions.show',
        'code' => 'show-permission',
        'description' => 'Show a permission',
        'group' => 'permission',
    ],
    'create-permission' => [
        'name' => 'permissions.create',
        'code' => 'create-permission',
        'description' => 'Show permission form',
        'group' => 'permission',
    ],
    'store-permission' => [
        'name' => 'permissions.store',
        'code' => 'store-permission',
        'description' => 'Store the permission',
        'group' => 'permission',
    ],
    'edit-permission' => [
        'name' => 'permissions.edit',
        'code' => 'edit-permission',
        'description' => 'Edit the permission',
        'group' => 'permission',
    ],
    'update-permission' => [
        'name' => 'permissions.update',
        'code' => 'update-permission',
        'description' => 'Update the permission',
        'group' => 'permission',
    ],
    'destroy-permission' => [
        'name' =>  'permissions.destroy',
        'code' => 'destroy-permission',
        'description' => 'Destroy the permission',
        'group' => 'permission',
    ],
    'trash-permission' => [
        'name' =>  'permissions.trash',
        'code' => 'trash-permission',
        'description' => 'Trash the permission',
        'group' => 'permission',
    ],
    'restore-permission' => [
        'name' => 'permissions.restore',
        'code' => 'restore-permission',
        'description' => 'Restore the permission',
        'group' => 'permission',
    ],
    'refresh-permission' => [
        'name' => 'permissions.refresh',
        'code' => 'refresh-permission',
        'description' => 'Refresh the permissions',
        'group' => 'permission',
    ],
    'reset-permission' => [
        'name' => 'permissions.reset',
        'code' => 'reset-permission',
        'description' => 'Reset the permissions',
        'group' => 'permission',
    ],
];
