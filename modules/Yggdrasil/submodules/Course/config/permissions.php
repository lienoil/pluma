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
    'edit-course' => [
        'name' => 'courses.edit',
        'code' => 'edit-course',
        'description' => 'Ability to show the form to edit course',
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

    /**
     * ------------------------------------------------------------------------------
     * Enrolled
     * ------------------------------------------------------------------------------
     */
    'view-enrolled-courses' => [
        'name' => 'courses.enrolled.index',
        'code' => 'view-enrolled-courses',
        'description' => 'Ability to view enrolled courses',
        'group' => ['course', 'student'],
    ],
    'show-enrolled-courses' => [
        'name' => 'courses.enrolled.show',
        'code' => 'show-enrolled-courses',
        'description' => 'Ability to view enrolled courses',
        'group' => ['course', 'student'],
    ],
    'enroll-course' => [
        'name' => 'courses.enroll',
        'code' => 'enroll-course',
        'description' => 'Ability to enroll to a course',
        'group' => ['course', 'student'],
    ],

    /**
     * ------------------------------------------------------------------------------
     * Student
     * ------------------------------------------------------------------------------
     */
    'all-course' => [
        'name' => 'courses.all',
        'code' => 'all-course',
        'description' => 'Ability to view list of courses',
        'group' => 'student',
    ],
    'single-course' => [
        'name' =>  'courses.single',
        'code' => 'single-course',
        'description' => 'Ability to view single course',
        'group' => 'student',
    ],
    'my-courses' => [
        'name' => 'courses.my',
        'code' => 'my-courses',
        'description' => 'Ability to view owned courses',
        'group' => 'student',
    ],

    /**
     * ------------------------------------------------------------------------------
     * Bookmarked
     * ------------------------------------------------------------------------------
     */
    'bookmarked-courses' => [
        'name' => 'courses.bookmarked',
        'code' => 'bookmarked-courses',
        'description' => 'Ability to view list bookmarked courses',
        'group' => 'student',
    ],
    'bookmark-course' => [
        'name' => 'courses.bookmark',
        'code' => 'bookmark-course',
        'description' => 'Ability to remove from a course from bookmark list',
        'group' => 'student',
    ],
    'unbookmark-course' => [
        'name' => 'courses.unbookmark',
        'code' => 'unbookmark-course',
        'description' => 'Ability to remove from a course from bokmarks list',
        'group' => 'student',
    ],
];
