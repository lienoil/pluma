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
     * Form Permissions
     * -------------------------------------------------------------------------
     *
     */
    'view-form' => [
        'name' =>  'view-form',
        'code' => 'forms.index',
        'description' => 'Ability to view list of forms',
        'group' => 'form',
    ],
    'show-form' => [
        'name' => 'show-form',
        'code' => 'forms.show',
        'description' => 'Ability to show a single form',
        'group' => 'form',
    ],
    'create-form' => [
        'name' => 'create-form',
        'code' => 'forms.create',
        'description' => 'Ability to show the form to create form',
        'group' => 'form',
    ],
    'store-form' => [
        'name' => 'store-form',
        'code' => 'forms.store',
        'description' => 'Ability to save the form',
        'group' => 'form',
    ],
    'edit-form' => [
        'name' => 'edit-form',
        'code' => 'forms.edit',
        'description' => 'Ability to show the form to edit form',
        'group' => 'form',
    ],
    'update-form' => [
        'name' => 'update-form',
        'code' => 'forms.update',
        'description' => 'Ability to update the form',
        'group' => 'form',
    ],
    'destroy-form' => [
        'name' =>  'destroy-form',
        'code' => 'forms.destroy',
        'description' => 'Ability to move the form to trash',
        'group' => 'form',
    ],
    'delete-form' => [
        'name' =>  'delete-form',
        'code' => 'forms.delete',
        'description' => 'Ability to permanently delete the form',
        'group' => 'form',
    ],
    'trash-form' => [
        'name' =>  'trash-form',
        'code' => 'forms.trash',
        'description' => 'Ability to view the list of all trashed form',
        'group' => 'form',
    ],
    'restore-form' => [
        'name' => 'restore-form',
        'code' => 'forms.restore',
        'description' => 'Ability to restore the form',
        'group' => 'form',
    ],

    // Many
    'destroy-many-form' => [
        'name' =>  'destroy-many-form',
        'code' => 'forms.many.destroy',
        'description' => 'Ability to destroy many forms',
        'group' => 'form',
    ],
    'delete-many-form' => [
        'name' =>  'delete-many-form',
        'code' => 'forms.many.delete',
        'description' => 'Ability to permanently delete many forms',
        'group' => 'form',
    ],
    'restore-many-form' => [
        'name' => 'restore-many-form',
        'code' => 'forms.many.restore',
        'description' => 'Ability to restore many forms',
        'group' => 'form',
    ],

    //
];
