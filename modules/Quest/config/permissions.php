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
     * Quest Permissions
     * -------------------------------------------------------------------------
     *
     */
    'view-quest' => [
        'name' => 'quests.index',
        'code' => 'view-quest',
        'description' => 'Ability to view list of quests',
        'group' => 'quest',
    ],
    'show-quest' => [
        'name' => 'quests.show',
        'code' => 'show-quest',
        'description' => 'Ability to show a single quest',
        'group' => 'quest',
    ],
    'create-quest' => [
        'name' => 'quests.create',
        'code' => 'create-quest',
        'description' => 'Ability to show the form to create quest',
        'group' => 'quest',
    ],
    'store-quest' => [
        'name' => 'quests.store',
        'code' => 'store-quest',
        'description' => 'Ability to save the quest',
        'group' => 'quest',
    ],
    'edit-quest' => [
        'name' => 'quests.edit',
        'code' => 'edit-quest',
        'description' => 'Ability to show the form to edit quest',
        'group' => 'quest',
    ],
    'update-quest' => [
        'name' => 'quests.update',
        'code' => 'update-quest',
        'description' => 'Ability to update the quest',
        'group' => 'quest',
    ],
    'destroy-quest' => [
        'name' =>  'quests.destroy',
        'code' => 'destroy-quest',
        'description' => 'Ability to move the quest to trash',
        'group' => 'quest',
    ],
    'delete-quest' => [
        'name' =>  'quests.delete',
        'code' => 'delete-quest',
        'description' => 'Ability to permanently delete the quest',
        'group' => 'quest',
    ],
    'trashed-quest' => [
        'name' => 'quests.trashed',
        'code' => 'trashed-quest',
        'description' => 'Ability to view the list of all trashed quest',
        'group' => 'quest',
    ],
    'restore-quest' => [
        'name' => 'quests.restore',
        'code' => 'restore-quest',
        'description' => 'Ability to restore the quest',
        'group' => 'quest',
    ],
];
