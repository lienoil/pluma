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
     * Task Permissions
     *--------------------------------------------------------------------------
     *
     */
    'view-tasks' => [
        'name' =>  'view-tasks',
        'code' => 'tasks.index',
        'description' => 'Ability to view list of tasks',
        'group' => 'task',
    ],
    'show-task' => [
        'name' => 'show-task',
        'code' => 'tasks.show',
        'description' => 'Ability to show a single task',
        'group' => 'task',
    ],
    'create-task' => [
        'name' => 'create-task',
        'code' => 'tasks.create',
        'description' => 'Ability to create new task',
        'group' => 'task',
    ],
    'store-task' => [
        'name' => 'store-task',
        'code' => 'tasks.store',
        'description' => 'Ability to save the task',
        'group' => 'task',
    ],
    'update-task' => [
        'name' => 'update-task',
        'code' => 'tasks.update',
        'description' => 'Ability to update the task',
        'group' => 'task',
    ],
    'destroy-task' => [
        'name' => 'destroy-task',
        'code' =>  'tasks.destroy',
        'description' => 'Ability to move the task to trash',
        'group' => 'task',
    ],
    'delete-task' => [
        'name' => 'delete-task',
        'code' =>  'tasks.delete',
        'description' => 'Ability to permanently delete the task',
        'group' => 'task',
    ],
    'trashed-tasks' => [
        'name' => 'trashed-tasks',
        'code' =>  'tasks.trashed',
        'description' => 'Ability to view the list of all trashed tasks',
        'group' => 'task',
    ],
    'restore-task' => [
        'name' => 'restore-task',
        'code' => 'tasks.restore',
        'description' => 'Ability to restore the task from trash',
        'group' => 'task',
    ],
];
