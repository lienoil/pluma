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
     * Frontman Permissions
     * -------------------------------------------------------------------------
     *
     */
    'view-frontman' => [
        'name' =>  'frontmen.index',
        'code' => 'view-frontman',
        'description' => 'Ability to view list of frontmen',
        'group' => 'frontman',
    ],
    'show-frontman' => [
        'name' => 'frontmen.show',
        'code' => 'show-frontman',
        'description' => 'Ability to show a single frontman',
        'group' => 'frontman',
    ],
    'create-frontman' => [
        'name' => 'frontmen.create',
        'code' => 'create-frontman',
        'description' => 'Ability to show the form to create frontman',
        'group' => 'frontman',
    ],
    'store-frontman' => [
        'name' => 'frontmen.store',
        'code' => 'store-frontman',
        'description' => 'Ability to save the frontman',
        'group' => 'frontman',
    ],
    'edit-frontman' => [
        'name' => 'frontmen.edit',
        'code' => 'edit-frontman',
        'description' => 'Ability to show the form to edit frontman',
        'group' => 'frontman',
    ],
    'update-frontman' => [
        'name' => 'frontmen.update',
        'code' => 'update-frontman',
        'description' => 'Ability to update the frontman',
        'group' => 'frontman',
    ],
    'destroy-frontman' => [
        'name' =>  'frontmen.destroy',
        'code' => 'destroy-frontman',
        'description' => 'Ability to move the frontman to trash',
        'group' => 'frontman',
    ],
    'delete-frontman' => [
        'name' =>  'frontmen.delete',
        'code' => 'delete-frontman',
        'description' => 'Ability to permanently delete the frontman',
        'group' => 'frontman',
    ],
    'trash-frontman' => [
        'name' =>  'frontmen.trash',
        'code' => 'trash-frontman',
        'description' => 'Ability to view the list of all trashed frontman',
        'group' => 'frontman',
    ],
    'restore-frontman' => [
        'name' => 'frontmen.restore',
        'code' => 'restore-frontman',
        'description' => 'Ability to restore the frontman',
        'group' => 'frontman',
    ],

    // Many
    'destroy-many-frontman' => [
        'name' =>  'frontmen.many.destroy',
        'code' => 'destroy-many-frontman',
        'description' => 'Ability to destroy many frontmen',
        'group' => 'frontman',
    ],
    'delete-many-frontman' => [
        'name' =>  'frontmen.many.delete',
        'code' => 'delete-many-frontman',
        'description' => 'Ability to permanently delete many frontmen',
        'group' => 'frontman',
    ],
    'restore-many-frontman' => [
        'name' => 'frontmen.many.restore',
        'code' => 'restore-many-frontman',
        'description' => 'Ability to restore many frontmen',
        'group' => 'frontman',
    ],

    //
];
