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
     * Test Permissions
     * -------------------------------------------------------------------------
     *
     */
    'view-test' => [
        'name' => 'tests.index',
        'code' => 'view-test',
        'description' => 'Ability to view list of tests',
        'group' => 'test',
    ],
    'show-test' => [
        'name' => 'tests.show',
        'code' => 'show-test',
        'description' => 'Ability to show a single test',
        'group' => 'test',
    ],
    'create-test' => [
        'name' => 'tests.create',
        'code' => 'create-test',
        'description' => 'Ability to show the form to create test',
        'group' => 'test',
    ],
    'store-test' => [
        'name' => 'tests.store',
        'code' => 'store-test',
        'description' => 'Ability to save the test',
        'group' => 'test',
    ],
    'edit-test' => [
        'name' => 'tests.edit',
        'code' => 'edit-test',
        'description' => 'Ability to show the form to edit test',
        'group' => 'test',
    ],
    'update-test' => [
        'name' => 'tests.update',
        'code' => 'update-test',
        'description' => 'Ability to update the test',
        'group' => 'test',
    ],
    'destroy-test' => [
        'name' =>  'tests.destroy',
        'code' => 'destroy-test',
        'description' => 'Ability to move the test to trash',
        'group' => 'test',
    ],
    'delete-test' => [
        'name' =>  'tests.delete',
        'code' => 'delete-test',
        'description' => 'Ability to permanently delete the test',
        'group' => 'test',
    ],
    'trashed-test' => [
        'name' => 'tests.trashed',
        'code' => 'trashed-test',
        'description' => 'Ability to view the list of all trashed test',
        'group' => 'test',
    ],
    'restore-test' => [
        'name' => 'tests.restore',
        'code' => 'restore-test',
        'description' => 'Ability to restore the test',
        'group' => 'test',
    ],
];
