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
     * Note Permissions
     * -------------------------------------------------------------------------
     *
     */
    'view-note' => [
        'name' => 'notes.index',
        'code' => 'view-note',
        'description' => 'Ability to view list of notes',
        'group' => 'note',
    ],
    'show-note' => [
        'name' => 'notes.show',
        'code' => 'show-note',
        'description' => 'Ability to show a single note',
        'group' => 'note',
    ],
    'create-note' => [
        'name' => 'notes.create',
        'code' => 'create-note',
        'description' => 'Ability to show the form to create note',
        'group' => 'note',
    ],
    'store-note' => [
        'name' => 'notes.store',
        'code' => 'store-note',
        'description' => 'Ability to save the note',
        'group' => 'note',
    ],
    'edit-note' => [
        'name' => 'notes.edit',
        'code' => 'edit-note',
        'description' => 'Ability to show the form to edit note',
        'group' => 'note',
    ],
    'update-note' => [
        'name' => 'notes.update',
        'code' => 'update-note',
        'description' => 'Ability to update the note',
        'group' => 'note',
    ],
    'destroy-note' => [
        'name' =>  'notes.destroy',
        'code' => 'destroy-note',
        'description' => 'Ability to move the note to trash',
        'group' => 'note',
    ],
    'delete-note' => [
        'name' =>  'notes.delete',
        'code' => 'delete-note',
        'description' => 'Ability to permanently delete the note',
        'group' => 'note',
    ],
    'trashed-note' => [
        'name' => 'notes.trashed',
        'code' => 'trashed-note',
        'description' => 'Ability to view the list of all trashed note',
        'group' => 'note',
    ],
    'restore-note' => [
        'name' => 'notes.restore',
        'code' => 'restore-note',
        'description' => 'Ability to restore the note',
        'group' => 'note',
    ],
];
