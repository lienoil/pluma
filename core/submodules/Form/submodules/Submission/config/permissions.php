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
     * Submission Permissions
     * -------------------------------------------------------------------------
     *
     */
    'view-submission' => [
        'name' => 'view-submission',
        'code' => 'submissions.index',
        'description' => 'Ability to view list of submissions',
        'group' => 'submission',
    ],
    'show-submission' => [
        'name' => 'show-submission',
        'code' => 'submissions.show',
        'description' => 'Ability to show a single submission',
        'group' => 'submission',
    ],
    'create-submission' => [
        'name' => 'create-submission',
        'code' => 'submissions.create',
        'description' => 'Ability to show the form to create submission',
        'group' => 'submission',
    ],
    'store-submission' => [
        'name' => 'store-submission',
        'code' => 'submissions.store',
        'description' => 'Ability to save the submission',
        'group' => 'submission',
    ],
    'edit-submission' => [
        'name' => 'edit-submission',
        'code' => 'submissions.edit',
        'description' => 'Ability to show the form to edit submission',
        'group' => 'submission',
    ],
    'update-submission' => [
        'name' => 'update-submission',
        'code' => 'submissions.update',
        'description' => 'Ability to update the submission',
        'group' => 'submission',
    ],
    'destroy-submission' => [
        'name' =>  'destroy-submission',
        'code' => 'submissions.destroy',
        'description' => 'Ability to move the submission to trash',
        'group' => 'submission',
    ],
    'delete-submission' => [
        'name' =>  'delete-submission',
        'code' => 'submissions.delete',
        'description' => 'Ability to permanently delete the submission',
        'group' => 'submission',
    ],
    'trashed-submission' => [
        'name' => 'trashed-submission',
        'code' => 'submissions.trashed',
        'description' => 'Ability to view the list of all trashed submission',
        'group' => 'submission',
    ],
    'restore-submission' => [
        'name' => 'restore-submission',
        'code' => 'submissions.restore',
        'description' => 'Ability to restore the submission',
        'group' => 'submission',
    ],
    'submit-submission' => [
        'name' => 'submit-submission',
        'code' => 'submissions.submit',
        'description' => 'Ability to submit the submission',
        'group' => 'submission',
    ],
    'restore-submission' => [
        'name' => 'restore-submission',
        'code' => 'submissions.restore',
        'description' => 'Ability to restore the submission',
        'group' => 'submission',
    ],
];
