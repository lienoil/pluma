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
     * -------------------------------------------------------------------------
     * Student Permissions
     * -------------------------------------------------------------------------
     *
     */
    'view-student' => [
        'name' => 'students.index',
        'code' => 'view-student',
        'description' => 'Ability to view list of students',
        'group' => 'student',
    ],
    'show-student' => [
        'name' => 'students.show',
        'code' => 'show-student',
        'description' => 'Ability to show a single student',
        'group' => 'student',
    ],
    'create-student' => [
        'name' => 'students.create',
        'code' => 'create-student',
        'description' => 'Ability to show the form to create student',
        'group' => 'student',
    ],
    'store-student' => [
        'name' => 'students.store',
        'code' => 'store-student',
        'description' => 'Ability to save the student',
        'group' => 'student',
    ],
    'edit-student' => [
        'name' => 'students.edit',
        'code' => 'edit-student',
        'description' => 'Ability to show the form to edit student',
        'group' => 'student',
    ],
    'update-student' => [
        'name' => 'students.update',
        'code' => 'update-student',
        'description' => 'Ability to update the student',
        'group' => 'student',
    ],
    'destroy-student' => [
        'name' =>  'students.destroy',
        'code' => 'destroy-student',
        'description' => 'Ability to move the student to trash',
        'group' => 'student',
    ],
    'delete-student' => [
        'name' =>  'students.delete',
        'code' => 'delete-student',
        'description' => 'Ability to permanently delete the student',
        'group' => 'student',
    ],
    'trashed-student' => [
        'name' => 'students.trashed',
        'code' => 'trashed-student',
        'description' => 'Ability to view the list of all trashed student',
        'group' => 'student',
    ],
    'restore-student' => [
        'name' => 'students.restore',
        'code' => 'restore-student',
        'description' => 'Ability to restore the student',
        'group' => 'student',
    ],
];
