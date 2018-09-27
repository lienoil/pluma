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
     * -------------------------------------------------------------------------
     * Menu Permissions
     * -------------------------------------------------------------------------
     *
     */
    'view-menu' => [
        'name' =>  'view-menu',
        'code' => 'menus.index',
        'description' => 'Ability to view list of menus',
        'group' => 'menu, appearance',
    ],
    'show-menu' => [
        'name' => 'show-menu',
        'code' => 'menus.show',
        'description' => 'Ability to show a single menu',
        'group' => 'menu, appearance',
    ],
    'create-menu' => [
        'name' => 'create-menu',
        'code' => 'menus.create',
        'description' => 'Ability to show the form to create menu',
        'group' => 'menu, appearance',
    ],
    'store-menu' => [
        'name' => 'store-menu',
        'code' => 'menus.store',
        'description' => 'Ability to save the menu',
        'group' => 'menu, appearance',
    ],
    'edit-menu' => [
        'name' => 'edit-menu',
        'code' => 'menus.edit',
        'description' => 'Ability to show the form to edit menu',
        'group' => 'menu, appearance',
    ],
    'update-menu' => [
        'name' => 'update-menu',
        'code' => 'menus.update',
        'description' => 'Ability to update the menu',
        'group' => 'menu, appearance',
    ],
    'destroy-menu' => [
        'name' =>  'destroy-menu',
        'code' => 'menus.destroy',
        'description' => 'Ability to move the menu to trash',
        'group' => 'menu, appearance',
    ],
    'delete-menu' => [
        'name' =>  'delete-menu',
        'code' => 'menus.delete',
        'description' => 'Ability to permanently delete the menu',
        'group' => 'menu, appearance',
    ],
    'trash-menu' => [
        'name' =>  'trash-menu',
        'code' => 'menus.trash',
        'description' => 'Ability to view the list of all trashed menu',
        'group' => 'menu, appearance',
    ],
    'restore-menu' => [
        'name' => 'restore-menu',
        'code' => 'menus.restore',
        'description' => 'Ability to restore the menu',
        'group' => 'menu, appearance',
    ],

    // Many
    'destroy-many-menu' => [
        'name' =>  'destroy-many-menu',
        'code' => 'menus.many.destroy',
        'description' => 'Ability to destroy many menus',
        'group' => 'menu, appearance',
    ],
    'delete-many-menu' => [
        'name' =>  'delete-many-menu',
        'code' => 'menus.many.delete',
        'description' => 'Ability to permanently delete many menus',
        'group' => 'menu, appearance',
    ],
    'restore-many-menu' => [
        'name' => 'restore-many-menu',
        'code' => 'menus.many.restore',
        'description' => 'Ability to restore many menus',
        'group' => 'menu, appearance',
    ],

    //
];
