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
        'name' => 'view-enrolled-courses',
        'code' => 'courses.enrolled.index',
        'description' => 'Ability to view enrolled courses',
        'group' => 'course',
    ],
    'show-enrolled-courses' => [
        'name' => 'show-enrolled-courses',
        'code' => 'courses.enrolled.show',
        'description' => 'Ability to view enrolled courses',
        'group' => 'course',
    ],
    'enroll-course' => [
        'name' => 'enroll-course',
        'code' => 'courses.enroll',
        'description' => 'Ability to enroll to a course',
        'group' => 'course',
    ],

    /**
     * ------------------------------------------------------------------------------
     * Student
     * ------------------------------------------------------------------------------
     */
    'all-course' => [
        'name' => 'all-course',
        'code' => 'courses.all',
        'description' => 'Ability to view list of courses',
        'group' => 'course',
    ],
    'single-course' => [
        'name' =>  'single-course',
        'code' => 'courses.single',
        'description' => 'Ability to view single course',
        'group' => 'course',
    ],
    'my-courses' => [
        'name' => 'my-courses',
        'code' => 'courses.my',
        'description' => 'Ability to view owned courses',
        'group' => 'course',
    ],

    /**
     * ------------------------------------------------------------------------------
     * Bookmarked
     * ------------------------------------------------------------------------------
     */
    'bookmarked-courses' => [
        'name' => 'bookmarked-courses',
        'code' => 'courses.bookmarked',
        'description' => 'Ability to view list bookmarked courses',
        'group' => 'course',
    ],
    'bookmark-course' => [
        'name' => 'bookmark-course',
        'code' => 'courses.bookmark',
        'description' => 'Ability to bookmark course',
        'group' => 'course',
    ],
    'unbookmark-course' => [
        'name' => 'unbookmark-course',
        'code' => 'courses.unbookmark',
        'description' => 'Ability to remove from a course from bokmarks list',
        'group' => 'course',
    ],
    'courses-bookmark-unbookmark' => [
        'name' => 'courses-bookmark-unbookmark',
        'code' => 'courses.bookmark.unbookmark',
        'description' => 'Ability to remove from a course from bookmark list',
        'group' => 'course',
    ],
    'courses-bookmark-bookmark' => [
        'name' => 'courses-bookmark-bookmark',
        'code' => 'courses.bookmark.bookmark',
        'description' => 'Ability to bookmark course',
        'group' => 'course',
    ],
];
