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
     * Library Permissions
     * -------------------------------------------------------------------------
     *
     */
    'view-library' => [
        'name' =>  'view-library',
        'code' => 'library.index',
        'description' => 'Ability to view list of library',
        'group' => 'library',
    ],
    'show-library' => [
        'name' => 'show-library',
        'code' => 'library.show',
        'description' => 'Ability to show a single library',
        'group' => 'library',
    ],
    'create-library' => [
        'name' => 'create-library',
        'code' => 'library.create',
        'description' => 'Ability to show the form to create library',
        'group' => 'library',
    ],
    'store-library' => [
        'name' => 'store-library',
            'code' => 'library.store',
            'description' => 'Ability to save the library',
        'group' => 'library',
    ],
    'edit-library' => [
        'name' => 'edit-library',
        'code' => 'library.edit',
        'description' => 'Ability to show the form to edit library',
        'group' => 'library',
    ],
    'update-library' => [
        'name' => 'update-library',
        'code' => 'library.update',
        'description' => 'Ability to update the library',
        'group' => 'library',
    ],
    'destroy-library' => [
        'name' =>  'destroy-library',
        'code' => 'library.destroy',
        'description' => 'Ability to move the library to trash',
        'group' => 'library',
    ],
    'delete-library' => [
        'name' =>  'delete-library',
        'code' => 'library.delete',
        'description' => 'Ability to permanently delete the library',
        'group' => 'library',
    ],
    'trash-library' => [
        'name' =>  'trash-library',
        'code' => 'library.trash',
        'description' => 'Ability to view the list of all trashed library',
        'group' => 'library',
    ],
    'restore-library' => [
        'name' => 'restore-library',
        'code' => 'library.restore',
        'description' => 'Ability to restore the library',
        'group' => 'library',
    ],

    // Many
    'destroy-many-library' => [
        'name' =>  'destroy-many-library',
        'code' => 'library.many.destroy',
        'description' => 'Ability to destroy many library',
        'group' => 'library',
    ],
    'delete-many-library' => [
        'name' =>  'delete-many-library',
        'code' => 'library.many.delete',
        'description' => 'Ability to permanently delete many library',
        'group' => 'library',
    ],
    'restore-many-library' => [
        'name' => 'restore-many-library',
        'code' => 'library.many.restore',
        'description' => 'Ability to restore many library',
        'group' => 'library',
    ],

    //
];
