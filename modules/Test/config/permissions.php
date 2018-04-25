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
     * Test Permissions
     *--------------------------------------------------------------------------
     *
     */
    'view-tests' => [
        'name' =>  'view-tests',
        'code' => 'tests.index',
        'description' => 'Ability to view list of tests',
        'group' => 'tests',
    ],
    'show-test' => [
        'name' => 'show-test',
        'code' => 'tests.show',
        'description' => 'Ability to show a single test',
        'group' => 'tests',
    ],
    'create-test' => [
        'name' => 'create-test',
        'code' => 'tests.create',
        'description' => 'Ability to create new test',
        'group' => 'tests',
    ],
    'store-test' => [
        'name' => 'store-test',
        'code' => 'tests.store',
        'description' => 'Ability to save the test',
        'group' => 'tests',
    ],
    'update-test' => [
        'name' => 'update-test',
        'code' => 'tests.update',
        'description' => 'Ability to update the test',
        'group' => 'tests',
    ],
    'destroy-test' => [
        'name' => 'destroy-test',
        'code' =>  'tests.destroy',
        'description' => 'Ability to move the test to trash',
        'group' => 'tests',
    ],
    'delete-test' => [
        'name' => 'delete-test',
        'code' =>  'tests.delete',
        'description' => 'Ability to permanently delete the test',
        'group' => 'tests',
    ],
    'trashed-tests' => [
        'name' => 'trashed-tests',
        'code' =>  'tests.trashed',
        'description' => 'Ability to view the list of all trashed tests',
        'group' => 'tests',
    ],
    'restore-test' => [
        'name' => 'restore-test',
        'code' => 'tests.restore',
        'description' => 'Ability to restore the test from trash',
        'group' => 'tests',
    ],
];
