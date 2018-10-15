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
     * $name Permissions
     *--------------------------------------------------------------------------
     *
     */
    'view-lessons' => [
        'name' =>  'view-lessons',
        'code' => 'lessons.index',
        'description' => 'Ability to view list of lessons',
        'group' => 'lesson',
    ],
    'show-lesson' => [
        'name' => 'show-lesson',
        'code' => 'lessons.show',
        'description' => 'Ability to show a single lesson',
        'group' => 'lesson',
    ],
    'create-lesson' => [
        'name' => 'create-lesson',
        'code' => 'lessons.create',
        'description' => 'Ability to create new lesson',
        'group' => 'lesson',
    ],
    'store-lesson' => [
        'name' => 'store-lesson',
        'code' => 'lessons.store',
        'description' => 'Ability to save the lesson',
        'group' => 'lesson',
    ],
    'edit-lesson' => [
        'name' => 'lessons.edit',
        'code' => 'edit-lesson',
        'description' => 'Ability to show the form to edit lesson',
        'group' => 'lesson',
    ],
    'update-lesson' => [
        'name' => 'update-lesson',
        'code' => 'lessons.update',
        'description' => 'Ability to update the lesson',
        'group' => 'lesson',
    ],
    'destroy-lesson' => [
        'name' => 'destroy-lesson',
        'code' =>  'lessons.destroy',
        'description' => 'Ability to move the lesson to trash',
        'group' => 'lesson',
    ],
    'delete-lesson' => [
        'name' => 'delete-lesson',
        'code' =>  'lessons.delete',
        'description' => 'Ability to permanently delete the lesson',
        'group' => 'lesson',
    ],
    'trashed-lessons' => [
        'name' => 'trashed-lessons',
        'code' =>  'lessons.trashed',
        'description' => 'Ability to view the list of all trashed lessons',
        'group' => 'lesson',
    ],
    'restore-lesson' => [
        'name' => 'restore-lesson',
        'code' => 'lessons.restore',
        'description' => 'Ability to restore the lesson from trash',
        'group' => 'lesson',
    ],

    // Many
    'destroy-many-lesson' => [
        'name' => 'destroy-many-lesson',
        'code' => 'lessons.many.destroy',
        'description' => 'Ability to destroy the lesson',
        'group' => 'lesson',
    ],
    'delete-many-lesson' => [
        'name' => 'delete-many-lesson',
        'code' => 'lessons.many.delete',
        'description' => 'Ability to permanently delete many lessons',
        'group' => 'lesson',
    ],
    'restore-many-lesson' => [
        'name' => 'restore-many-lesson',
        'code' => 'lessons.many.restore',
        'description' => 'Ability to restore many lessons',
        'group' => 'lesson',
    ],
];
