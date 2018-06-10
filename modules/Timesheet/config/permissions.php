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
     * Timesheet Permissions
     *--------------------------------------------------------------------------
     *
     */
    'view-timesheets' => [
        'name' =>  'view-timesheets',
        'code' => 'timesheets.index',
        'description' => 'Ability to view list of timesheets',
        'group' => 'timesheet',
    ],
    'show-timesheet' => [
        'name' => 'show-timesheet',
        'code' => 'timesheets.show',
        'description' => 'Ability to show a single timesheet',
        'group' => 'timesheet',
    ],
    'create-timesheet' => [
        'name' => 'create-timesheet',
        'code' => 'timesheets.create',
        'description' => 'Ability to create new timesheet',
        'group' => 'timesheet',
    ],
    'store-timesheet' => [
        'name' => 'store-timesheet',
        'code' => 'timesheets.store',
        'description' => 'Ability to save the timesheet',
        'group' => 'timesheet',
    ],
    'update-timesheet' => [
        'name' => 'update-timesheet',
        'code' => 'timesheets.update',
        'description' => 'Ability to update the timesheet',
        'group' => 'timesheet',
    ],
    'destroy-timesheet' => [
        'name' => 'destroy-timesheet',
        'code' =>  'timesheets.destroy',
        'description' => 'Ability to move the timesheet to trash',
        'group' => 'timesheet',
    ],
    'delete-timesheet' => [
        'name' => 'delete-timesheet',
        'code' =>  'timesheets.delete',
        'description' => 'Ability to permanently delete the timesheet',
        'group' => 'timesheet',
    ],
    'trashed-timesheets' => [
        'name' => 'trashed-timesheets',
        'code' =>  'timesheets.trashed',
        'description' => 'Ability to view the list of all trashed timesheets',
        'group' => 'timesheet',
    ],
    'restore-timesheet' => [
        'name' => 'restore-timesheet',
        'code' => 'timesheets.restore',
        'description' => 'Ability to restore the timesheet from trash',
        'group' => 'timesheet',
    ],
];
