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
     * Role Permissions
     *
     */
    'view-role' => [
        'name' =>  'roles.index',
        'code' => 'view-role',
        'description' => 'Ability to view list of roles',
        'group' => 'role',
    ],
    'show-role' => [
        'name' => 'roles.show',
        'code' => 'show-role',
        'description' => 'Ability to show a single role',
        'group' => 'role',
    ],
    'create-role' => [
        'name' => 'roles.create',
        'code' => 'create-role',
        'description' => 'Ability to show the form to create role',
        'group' => 'role',
    ],
    'store-role' => [
        'name' => 'roles.store',
        'code' => 'store-role',
        'description' => 'Ability to save the role',
        'group' => 'role',
    ],
    'edit-role' => [
        'name' => 'roles.edit',
        'code' => 'edit-role',
        'description' => 'Ability to show the form to edit role',
        'group' => 'role',
    ],
    'update-role' => [
        'name' => 'roles.update',
        'code' => 'update-role',
        'description' => 'Ability to update the role',
        'group' => 'role',
    ],
    'destroy-role' => [
        'name' =>  'roles.destroy',
        'code' => 'destroy-role',
        'description' => 'Ability to move the role to trash',
        'group' => 'role',
    ],
    'delete-role' => [
        'name' =>  'roles.delete',
        'code' => 'delete-role',
        'description' => 'Ability to permanently delete the role',
        'group' => 'role',
    ],
    'trash-role' => [
        'name' =>  'roles.trash',
        'code' => 'trash-role',
        'description' => 'Ability to view the list of all trashed role',
        'group' => 'role',
    ],
    'restore-role' => [
        'name' => 'roles.restore',
        'code' => 'restore-role',
        'description' => 'Ability to restore the role',
        'group' => 'role',
    ],

    // Many
    'destroy-many-role' => [
        'name' =>  'roles.many.destroy',
        'code' => 'destroy-many-role',
        'description' => 'Ability to destroy many roles',
        'group' => 'role',
    ],
    'delete-many-role' => [
        'name' =>  'roles.many.delete',
        'code' => 'delete-many-role',
        'description' => 'Ability to permanently delete many roles',
        'group' => 'role',
    ],
    'restore-many-role' => [
        'name' => 'roles.many.restore',
        'code' => 'restore-many-role',
        'description' => 'Ability to restore many roles',
        'group' => 'role',
    ],

    /**
     * Grant Permissions
     *
     */
    'view-grant' => [
        'name' =>  'grants.index',
        'code' => 'view-grant',
        'description' => 'Ability to view list of grants',
        'group' => 'grant',
    ],
    'show-grant' => [
        'name' => 'grants.show',
        'code' => 'show-grant',
        'description' => 'Ability to show a single grant',
        'group' => 'grant',
    ],
    'create-grant' => [
        'name' => 'grants.create',
        'code' => 'create-grant',
        'description' => 'Ability to show the form to create grant',
        'group' => 'grant',
    ],
    'store-grant' => [
        'name' => 'grants.store',
        'code' => 'store-grant',
        'description' => 'Ability to save the grant',
        'group' => 'grant',
    ],
    'edit-grant' => [
        'name' => 'grants.edit',
        'code' => 'edit-grant',
        'description' => 'Ability to show the form to edit grant',
        'group' => 'grant',
    ],
    'update-grant' => [
        'name' => 'grants.update',
        'code' => 'update-grant',
        'description' => 'Ability to update the grant',
        'group' => 'grant',
    ],
    'destroy-grant' => [
        'name' =>  'grants.destroy',
        'code' => 'destroy-grant',
        'description' => 'Ability to move the grant to trash',
        'group' => 'grant',
    ],
    'delete-grant' => [
        'name' =>  'grants.delete',
        'code' => 'delete-grant',
        'description' => 'Ability to permanently delete the grant',
        'group' => 'grant',
    ],
    'trash-grant' => [
        'name' =>  'grants.trash',
        'code' => 'trash-grant',
        'description' => 'Ability to view the list of all trashed grant',
        'group' => 'grant',
    ],
    'restore-grant' => [
        'name' => 'grants.restore',
        'code' => 'restore-grant',
        'description' => 'Ability to restore the grant',
        'group' => 'grant',
    ],

    // Many
    'destroy-many-grant' => [
        'name' =>  'grants.many.destroy',
        'code' => 'destroy-many-grant',
        'description' => 'Ability to destroy many grants',
        'group' => 'grant',
    ],
    'delete-many-grant' => [
        'name' =>  'grants.many.delete',
        'code' => 'delete-many-grant',
        'description' => 'Ability to permanently delete many grants',
        'group' => 'grant',
    ],
    'restore-many-grant' => [
        'name' => 'grants.many.restore',
        'code' => 'restore-many-grant',
        'description' => 'Ability to restore many grants',
        'group' => 'grant',
    ],

    /**
     * Permissions Permissions
     *
     */
    'view-permission' => [
        'name' =>  'permissions.index',
        'code' => 'view-permission',
        'description' => 'Ability to view list of permissions',
        'group' => 'permission',
    ],
    'show-permission' => [
        'name' => 'permissions.show',
        'code' => 'show-permission',
        'description' => 'Ability to show a single permission',
        'group' => 'permission',
    ],
    'create-permission' => [
        'name' => 'permissions.create',
        'code' => 'create-permission',
        'description' => 'Ability to show the form to create permission',
        'group' => 'permission',
    ],
    'store-permission' => [
        'name' => 'permissions.store',
        'code' => 'store-permission',
        'description' => 'Ability to save the permission',
        'group' => 'permission',
    ],
    'edit-permission' => [
        'name' => 'permissions.edit',
        'code' => 'edit-permission',
        'description' => 'Ability to show the form to edit permission',
        'group' => 'permission',
    ],
    'update-permission' => [
        'name' => 'permissions.update',
        'code' => 'update-permission',
        'description' => 'Ability to update the permission',
        'group' => 'permission',
    ],
    'destroy-permission' => [
        'name' =>  'permissions.destroy',
        'code' => 'destroy-permission',
        'description' => 'Ability to move the permission to trash',
        'group' => 'permission',
    ],
    'delete-permission' => [
        'name' =>  'permissions.delete',
        'code' => 'delete-permission',
        'description' => 'Ability to permanently delete the permission',
        'group' => 'permission',
    ],
    'trash-permission' => [
        'name' =>  'permissions.trash',
        'code' => 'trash-permission',
        'description' => 'Ability to view the list of all trashed permission',
        'group' => 'permission',
    ],
    'restore-permission' => [
        'name' => 'permissions.restore',
        'code' => 'restore-permission',
        'description' => 'Ability to restore the permission',
        'group' => 'permission',
    ],

    // Many
    'destroy-many-permission' => [
        'name' =>  'permissions.many.destroy',
        'code' => 'destroy-many-permission',
        'description' => 'Ability to destroy many permissions',
        'group' => 'permission',
    ],
    'delete-many-permission' => [
        'name' =>  'permissions.many.delete',
        'code' => 'delete-many-permission',
        'description' => 'Ability to permanently delete many permissions',
        'group' => 'permission',
    ],
    'restore-many-permission' => [
        'name' => 'permissions.many.restore',
        'code' => 'restore-many-permission',
        'description' => 'Ability to restore many permissions',
        'group' => 'permission',
    ],
    'refresh-permission' => [
        'name' => 'permissions.refresh',
        'code' => 'refresh-permission',
        'description' => 'Ability to refresh the permissions',
        'group' => 'permission',
    ],
    'reset-permission' => [
        'name' => 'permissions.reset',
        'code' => 'reset-permission',
        'description' => 'Ability to reset the permissions',
        'group' => 'permission',
    ],
];
