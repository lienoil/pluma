<?php

/**
 * -----------------------------------------------------------------------------
 * Admin Submission Route
 * -----------------------------------------------------------------------------
 *
 * Handles the admin routes.
 *
 */

// SoftDelete routes
Route::get('forms/submissions/trashed', 'SubmissionController@trashed')
     ->name('submissions.trashed');

Route::patch('forms/submissions/restore/{submission}', 'SubmissionController@restore')
     ->name('submissions.restore');

Route::delete('forms/submissions/delete/{submission}', 'SubmissionController@delete')
     ->name('submissions.delete');

// Admin routes
Route::resource('forms/submissions', 'SubmissionController');
