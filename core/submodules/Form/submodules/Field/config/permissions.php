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
     * Field Permissions
     * -------------------------------------------------------------------------
     *
     */
    'view-field' => [
        'name' =>  'view-field',
        'code' => 'fields.index',
        'description' => 'Ability to view list of fields',
        'group' => 'field',
    ],
    'show-field' => [
        'name' => 'show-field',
        'code' => 'fields.show',
        'description' => 'Ability to show a single field',
        'group' => 'field',
    ],
    'create-field' => [
        'name' => 'create-field',
        'code' => 'fields.create',
        'description' => 'Ability to show the form to create field',
        'group' => 'field',
    ],
    'store-field' => [
        'name' => 'store-field',
        'code' => 'fields.store',
        'description' => 'Ability to save the field',
        'group' => 'field',
    ],
    'edit-field' => [
        'name' => 'edit-field',
        'code' => 'fields.edit',
        'description' => 'Ability to show the form to edit field',
        'group' => 'field',
    ],
    'update-field' => [
        'name' => 'update-field',
        'code' => 'fields.update',
        'description' => 'Ability to update the field',
        'group' => 'field',
    ],
    'destroy-field' => [
        'name' =>  'destroy-field',
        'code' => 'fields.destroy',
        'description' => 'Ability to move the field to trash',
        'group' => 'field',
    ],
    'delete-field' => [
        'name' =>  'delete-field',
        'code' => 'fields.delete',
        'description' => 'Ability to permanently delete the field',
        'group' => 'field',
    ],
    'trash-field' => [
        'name' =>  'trash-field',
        'code' => 'fields.trash',
        'description' => 'Ability to view the list of all trashed field',
        'group' => 'field',
    ],
    'restore-field' => [
        'name' => 'restore-field',
        'code' => 'fields.restore',
        'description' => 'Ability to restore the field',
        'group' => 'field',
    ],

    // Many
    'destroy-many-field' => [
        'name' =>  'destroy-many-field',
        'code' => 'fields.many.destroy',
        'description' => 'Ability to destroy many fields',
        'group' => 'field',
    ],
    'delete-many-field' => [
        'name' =>  'delete-many-field',
        'code' => 'fields.many.delete',
        'description' => 'Ability to permanently delete many fields',
        'group' => 'field',
    ],
    'restore-many-field' => [
        'name' => 'restore-many-field',
        'code' => 'fields.many.restore',
        'description' => 'Ability to restore many fields',
        'group' => 'field',
    ],

    //
];
