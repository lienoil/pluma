<?php
/**
 *------------------------------------------------------------------------------
 * Permissions Array
 *------------------------------------------------------------------------------
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
     *--------------------------------------------------------------------------
     * Assignment Permissions
     *--------------------------------------------------------------------------
     *
     */
    'view-assignments' => [
        'name' =>  'view-assignments',
        'code' => 'assignments.index',
        'description' => 'Ability to view list of assignments',
        'group' => 'assignment',
    ],
    'show-assignment' => [
        'name' => 'show-assignment',
        'code' => 'assignments.show',
        'description' => 'Ability to show a single assignment',
        'group' => 'assignment',
    ],
    'create-assignment' => [
        'name' => 'create-assignment',
        'code' => 'assignments.create',
        'description' => 'Ability to create new assignment',
        'group' => 'assignment',
    ],
    'store-assignment' => [
        'name' => 'store-assignment',
        'code' => 'assignments.store',
        'description' => 'Ability to save the assignment',
        'group' => 'assignment',
    ],
    'edit-assignment' => [
        'name' => 'assignments.edit',
        'code' => 'edit-assignment',
        'description' => 'Ability to show the form to edit assignment',
        'group' => 'assignment',
    ],
    'update-assignment' => [
        'name' => 'update-assignment',
        'code' => 'assignments.update',
        'description' => 'Ability to update the assignment',
        'group' => 'assignment',
    ],
    'destroy-assignment' => [
        'name' => 'destroy-assignment',
        'code' =>  'assignments.destroy',
        'description' => 'Ability to move the assignment to trash',
        'group' => 'assignment',
    ],
    'delete-assignment' => [
        'name' => 'delete-assignment',
        'code' =>  'assignments.delete',
        'description' => 'Ability to permanently delete the assignment',
        'group' => 'assignment',
    ],
    'trashed-assignments' => [
        'name' => 'trashed-assignments',
        'code' =>  'assignments.trashed',
        'description' => 'Ability to view the list of all trashed assignments',
        'group' => 'assignment',
    ],
    'restore-assignment' => [
        'name' => 'restore-assignment',
        'code' => 'assignments.restore',
        'description' => 'Ability to restore the assignment from trash',
        'group' => 'assignment',
    ],

    // Many
    'destroy-many-assignment' => [
        'name' => 'assignments.many.destroy',
        'code' => 'destroy-many-assignment',
        'description' => 'Ability to permanently delete many assignments',
        'group' => 'assignment',
    ],
    'delete-many-assignment' => [
        'name' => 'assignments.many.delete',
        'code' => 'delete-many-assignment',
        'description' => 'Ability to permanently delete many assignments',
        'group' => 'assignment',
    ],
    'restore-many-assignment' => [
        'name' => 'assignments.many.restore',
        'code' => 'restore-many-assignment',
        'description' => 'Ability to restore many assignments',
        'group' => 'assignment',
    ],
];
