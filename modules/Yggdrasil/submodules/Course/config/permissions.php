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
     * Course Permissions
     *
     */
    'view-course' => [
        'name' =>  'courses.index',
        'code' => 'view-course',
        'description' => 'Ability to view list of courses',
        'group' => ['course'],
    ],
    'show-course' => [
        'name' => 'courses.show',
        'code' => 'show-course',
        'description' => 'Ability to show a single course',
        'group' => ['course'],
    ],
    'create-course' => [
        'name' => 'courses.create',
        'code' => 'create-course',
        'description' => 'Ability to show the form to create course',
        'group' => 'course',
    ],
    'store-course' => [
        'name' => 'courses.store',
        'code' => 'store-course',
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
        'name' => 'courses.update',
        'code' => 'update-course',
        'description' => 'Ability to update the course',
        'group' => 'course',
    ],
    'destroy-course' => [
        'name' =>  'courses.destroy',
        'code' => 'destroy-course',
        'description' => 'Ability to move the course to trash',
        'group' => 'course',
    ],
    'delete-course' => [
        'name' =>  'courses.delete',
        'code' => 'delete-course',
        'description' => 'Ability to permanently delete the course',
        'group' => 'course',
    ],
    'trash-course' => [
        'name' =>  'courses.trash',
        'code' => 'trash-course',
        'description' => 'Ability to view the list of all trashed course',
        'group' => 'course',
    ],
    'restore-course' => [
        'name' => 'courses.restore',
        'code' => 'restore-course',
        'description' => 'Ability to restore the course',
        'group' => 'course',
    ],

    // Enrolled
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

    // Student
    'all-courses' => [
        'name' =>  'courses.all',
        'code' => 'all-courses',
        'description' => 'Ability to view list of courses',
        'group' => ['student'],
    ],
    'single-course' => [
        'name' =>  'courses.single',
        'code' => 'single-course',
        'description' => 'Ability to view single course',
        'group' => ['student'],
    ],
    'my-courses' => [
        'name' =>  'courses.my',
        'code' => 'my-courses',
        'description' => 'Ability to view owned courses',
        'group' => ['student'],
    ],
    // Bookmarked
    'bookmarked-courses' => [
        'name' => 'courses.bookmarked',
        'code' => 'bookmarked-courses',
        'description' => 'Ability to view list bookmarked courses',
        'group' => ['student'],
    ],
    'bookmark-course' => [
        'name' => 'courses.bookmark',
        'code' => 'bookmark-course',
        'description' => 'Ability to bookmark a course',
        'group' => ['student'],
    ],
    'unbookmark-course' => [
        'name' => 'courses.unbookmark',
        'code' => 'unbookmark-course',
        'description' => 'Ability to remove from a course from bookmarks list',
        'group' => ['student'],
    ],
];
