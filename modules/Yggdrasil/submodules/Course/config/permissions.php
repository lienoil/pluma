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
     * Course Permissions
     *--------------------------------------------------------------------------
     *
     */
    'view-courses' => [
        'name' =>  'view-courses',
        'code' => 'courses.index',
        'description' => 'Ability to view list of courses',
        'group' => 'course',
    ],
    'show-course' => [
        'name' => 'show-course',
        'code' => 'courses.show',
        'description' => 'Ability to show a single course',
        'group' => 'course',
    ],
    'create-course' => [
        'name' => 'create-course',
        'code' => 'courses.create',
        'description' => 'Ability to create new course',
        'group' => 'course',
    ],
    'store-course' => [
        'name' => 'store-course',
        'code' => 'courses.store',
        'description' => 'Ability to save the course',
        'group' => 'course',
    ],
    'update-course' => [
        'name' => 'update-course',
        'code' => 'courses.update',
        'description' => 'Ability to update the course',
        'group' => 'course',
    ],
    'destroy-course' => [
        'name' => 'destroy-course',
        'code' =>  'courses.destroy',
        'description' => 'Ability to move the course to trash',
        'group' => 'course',
    ],
    'delete-course' => [
        'name' => 'delete-course',
        'code' =>  'courses.delete',
        'description' => 'Ability to permanently delete the course',
        'group' => 'course',
    ],
    'trashed-courses' => [
        'name' => 'trashed-courses',
        'code' =>  'courses.trashed',
        'description' => 'Ability to view the list of all trashed courses',
        'group' => 'course',
    ],
    'restore-course' => [
        'name' => 'restore-course',
        'code' => 'courses.restore',
        'description' => 'Ability to restore the course from trash',
        'group' => 'course',
    ],
];
