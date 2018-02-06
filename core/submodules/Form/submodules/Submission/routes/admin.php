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
Route::get('submissions/trashed', 'SubmissionController@trashed')
     ->name('submissions.trashed');

Route::patch('submissions/restore/{fieldtype}', 'SubmissionController@restore')
     ->name('submissions.restore');

Route::delete('submissions/delete/{fieldtype}', 'SubmissionController@delete')
     ->name('submissions.delete');

Route::post('forms/submissions/submit', 'SubmissionController@submit')->name('submissions.submit');

// Admin routes
Route::resource('forms/submissions', 'SubmissionController')->except(['store']);
