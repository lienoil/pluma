<?php

/**
 * -----------------------------------------------------------------------------
 * Public Route
 * -----------------------------------------------------------------------------
 *
 * Handles the public facing routes.
 *
 */

Route::get('announcements/all', 'AnnouncementController@all')->name('announcements.all');
Route::get('announcements/{announcement}', 'AnnouncementController@single')->name('announcements.single');
