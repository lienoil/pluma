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
     * Fieldtype Permissions
     * -------------------------------------------------------------------------
     *
     */
    'view-fieldtype' => [
        'name' =>  'view-fieldtype',
        'code' => 'fieldtypes.index',
        'description' => 'Ability to view list of fieldtypes',
        'group' => 'fieldtype',
    ],
    'show-fieldtype' => [
        'name' => 'show-fieldtype',
        'code' => 'fieldtypes.show',
        'description' => 'Ability to show a single fieldtype',
        'group' => 'fieldtype',
    ],
    'create-fieldtype' => [
        'name' => 'create-fieldtype',
        'code' => 'fieldtypes.create',
        'description' => 'Ability to show the form to create fieldtype',
        'group' => 'fieldtype',
    ],
    'store-fieldtype' => [
        'name' => 'store-fieldtype',
        'code' => 'fieldtypes.store',
        'description' => 'Ability to save the fieldtype',
        'group' => 'fieldtype',
    ],
    'edit-fieldtype' => [
        'name' => 'edit-fieldtype',
        'code' => 'fieldtypes.edit',
        'description' => 'Ability to show the form to edit fieldtype',
        'group' => 'fieldtype',
    ],
    'update-fieldtype' => [
        'name' => 'update-fieldtype',
        'code' => 'fieldtypes.update',
        'description' => 'Ability to update the fieldtype',
        'group' => 'fieldtype',
    ],
    'destroy-fieldtype' => [
        'name' =>  'destroy-fieldtype',
        'code' => 'fieldtypes.destroy',
        'description' => 'Ability to move the fieldtype to trash',
        'group' => 'fieldtype',
    ],
    'delete-fieldtype' => [
        'name' =>  'delete-fieldtype',
        'code' => 'fieldtypes.delete',
        'description' => 'Ability to permanently delete the fieldtype',
        'group' => 'fieldtype',
    ],
    'trash-fieldtype' => [
        'name' =>  'trash-fieldtype',
        'code' => 'fieldtypes.trash',
        'description' => 'Ability to view the list of all trashed fieldtype',
        'group' => 'fieldtype',
    ],
    'restore-fieldtype' => [
        'name' => 'restore-fieldtype',
        'code' => 'fieldtypes.restore',
        'description' => 'Ability to restore the fieldtype',
        'group' => 'fieldtype',
    ],

    // Many
    'destroy-many-fieldtype' => [
        'name' =>  'destroy-many-fieldtype',
        'code' => 'fieldtypes.many.destroy',
        'description' => 'Ability to destroy many fieldtypes',
        'group' => 'fieldtype',
    ],
    'delete-many-fieldtype' => [
        'name' =>  'delete-many-fieldtype',
        'code' => 'fieldtypes.many.delete',
        'description' => 'Ability to permanently delete many fieldtypes',
        'group' => 'fieldtype',
    ],
    'restore-many-fieldtype' => [
        'name' => 'restore-many-fieldtype',
        'code' => 'fieldtypes.many.restore',
        'description' => 'Ability to restore many fieldtypes',
        'group' => 'fieldtype',
    ],

    //
];
