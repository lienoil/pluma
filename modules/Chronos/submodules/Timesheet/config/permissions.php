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
     * Timesheet Permissions
     * -------------------------------------------------------------------------
     *
     */
    'view-timesheet' => [
        'name' =>  'timesheets.index',
        'code' => 'view-timesheet',
        'description' => 'Ability to view list of timesheets',
        'group' => 'timesheet',
    ],
    'show-timesheet' => [
        'name' => 'timesheets.show',
        'code' => 'show-timesheet',
        'description' => 'Ability to show a single timesheet',
        'group' => 'timesheet',
    ],
    'create-timesheet' => [
        'name' => 'timesheets.create',
        'code' => 'create-timesheet',
        'description' => 'Ability to show the form to create timesheet',
        'group' => 'timesheet',
    ],
    'store-timesheet' => [
        'name' => 'timesheets.store',
        'code' => 'store-timesheet',
        'description' => 'Ability to save the timesheet',
        'group' => 'timesheet',
    ],
    'edit-timesheet' => [
        'name' => 'timesheets.edit',
        'code' => 'edit-timesheet',
        'description' => 'Ability to show the form to edit timesheet',
        'group' => 'timesheet',
    ],
    'update-timesheet' => [
        'name' => 'timesheets.update',
        'code' => 'update-timesheet',
        'description' => 'Ability to update the timesheet',
        'group' => 'timesheet',
    ],
    'destroy-timesheet' => [
        'name' =>  'timesheets.destroy',
        'code' => 'destroy-timesheet',
        'description' => 'Ability to move the timesheet to trash',
        'group' => 'timesheet',
    ],
    'delete-timesheet' => [
        'name' =>  'timesheets.delete',
        'code' => 'delete-timesheet',
        'description' => 'Ability to permanently delete the timesheet',
        'group' => 'timesheet',
    ],
    'trash-timesheet' => [
        'name' =>  'timesheets.trash',
        'code' => 'trash-timesheet',
        'description' => 'Ability to view the list of all trashed timesheet',
        'group' => 'timesheet',
    ],
    'restore-timesheet' => [
        'name' => 'timesheets.restore',
        'code' => 'restore-timesheet',
        'description' => 'Ability to restore the timesheet',
        'group' => 'timesheet',
    ],

    // Many
    'destroy-many-timesheet' => [
        'name' =>  'timesheets.many.destroy',
        'code' => 'destroy-many-timesheet',
        'description' => 'Ability to destroy many timesheets',
        'group' => 'timesheet',
    ],
    'delete-many-timesheet' => [
        'name' =>  'timesheets.many.delete',
        'code' => 'delete-many-timesheet',
        'description' => 'Ability to permanently delete many timesheets',
        'group' => 'timesheet',
    ],
    'restore-many-timesheet' => [
        'name' => 'timesheets.many.restore',
        'code' => 'restore-many-timesheet',
        'description' => 'Ability to restore many timesheets',
        'group' => 'timesheet',
    ],

    //
];
