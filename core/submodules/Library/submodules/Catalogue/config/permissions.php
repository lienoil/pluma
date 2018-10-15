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
     * Catalogue Permissions
     * -------------------------------------------------------------------------
     *
     */
    'view-catalogue' => [
        'name' =>  'view-catalogue',
        'code' => 'catalogues.index',
        'description' => 'Ability to view list of catalogues',
        'group' => 'catalogue',
    ],
    'show-catalogue' => [
        'name' => 'show-catalogue',
        'code' => 'catalogues.show',
        'description' => 'Ability to show a single catalogue',
        'group' => 'catalogue',
    ],
    'create-catalogue' => [
        'name' => 'create-catalogue',
        'code' => 'catalogues.create',
        'description' => 'Ability to show the form to create catalogue',
        'group' => 'catalogue',
    ],
    'store-catalogue' => [
        'name' => 'store-catalogue',
        'code' => 'catalogues.store',
        'description' => 'Ability to save the catalogue',
        'group' => 'catalogue',
    ],
    'edit-catalogue' => [
        'name' => 'edit-catalogue',
        'code' => 'catalogues.edit',
        'description' => 'Ability to show the form to edit catalogue',
        'group' => 'catalogue',
    ],
    'update-catalogue' => [
        'name' => 'update-catalogue',
        'code' => 'catalogues.update',
        'description' => 'Ability to update the catalogue',
        'group' => 'catalogue',
    ],
    'destroy-catalogue' => [
        'name' =>  'destroy-catalogue',
        'code' => 'catalogues.destroy',
        'description' => 'Ability to move the catalogue to trash',
        'group' => 'catalogue',
    ],
    'delete-catalogue' => [
        'name' =>  'delete-catalogue',
        'code' => 'catalogues.delete',
        'description' => 'Ability to permanently delete the catalogue',
        'group' => 'catalogue',
    ],
    'trash-catalogue' => [
        'name' =>  'trash-catalogue',
        'code' => 'catalogues.trash',
        'description' => 'Ability to view the list of all trashed catalogue',
        'group' => 'catalogue',
    ],
    'restore-catalogue' => [
        'name' => 'restore-catalogue',
        'code' => 'catalogues.restore',
        'description' => 'Ability to restore the catalogue',
        'group' => 'catalogue',
    ],

    // Many
    'destroy-many-catalogue' => [
        'name' =>  'destroy-many-catalogue',
        'code' => 'catalogues.many.destroy',
        'description' => 'Ability to destroy many catalogues',
        'group' => 'catalogue',
    ],
    'delete-many-catalogue' => [
        'name' =>  'delete-many-catalogue',
        'code' => 'catalogues.many.delete',
        'description' => 'Ability to permanently delete many catalogues',
        'group' => 'catalogue',
    ],
    'restore-many-catalogue' => [
        'name' => 'restore-many-catalogue',
        'code' => 'catalogues.many.restore',
        'description' => 'Ability to restore many catalogues',
        'group' => 'catalogue',
    ],

    //
];
