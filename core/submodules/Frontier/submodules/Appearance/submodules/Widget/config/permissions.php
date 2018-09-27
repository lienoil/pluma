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
     * Widget Permissions
     * -------------------------------------------------------------------------
     *
     */
    'view-widget' => [
        'name' =>  'view-widget',
        'code' => 'widgets.index',
        'description' => 'Ability to view list of widgets',
        'group' => 'widget, appearance',
    ],
    'show-widget' => [
        'name' => 'show-widget',
        'code' => 'widgets.show',
        'description' => 'Ability to show a single widget',
        'group' => 'widget, appearance',
    ],
    'create-widget' => [
        'name' => 'create-widget',
        'code' => 'widgets.create',
        'description' => 'Ability to show the form to create widget',
        'group' => 'widget, appearance',
    ],
    'store-widget' => [
        'name' => 'store-widget',
        'code' => 'widgets.store',
        'description' => 'Ability to save the widget',
        'group' => 'widget, appearance',
    ],
    'edit-widget' => [
        'name' => 'edit-widget',
        'code' => 'widgets.edit',
        'description' => 'Ability to show the form to edit widget',
        'group' => 'widget, appearance',
    ],
    'update-widget' => [
        'name' => 'update-widget',
        'code' => 'widgets.update',
        'description' => 'Ability to update the widget',
        'group' => 'widget, appearance',
    ],
    'destroy-widget' => [
        'name' =>  'destroy-widget',
        'code' => 'widgets.destroy',
        'description' => 'Ability to move the widget to trash',
        'group' => 'widget, appearance',
    ],
    'delete-widget' => [
        'name' =>  'delete-widget',
        'code' => 'widgets.delete',
        'description' => 'Ability to permanently delete the widget',
        'group' => 'widget, appearance',
    ],
    'trashed-widget' => [
        'name' =>  'trashed-widget',
        'code' => 'widgets.trashed',
        'description' => 'Ability to view the list of all trashed widget',
        'group' => 'widget, appearance',
    ],
    'restore-widget' => [
        'name' => 'restore-widget',
        'code' => 'widgets.restore',
        'description' => 'Ability to restore the widget',
        'group' => 'widget, appearance',
    ],
];
