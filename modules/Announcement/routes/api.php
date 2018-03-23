<?php

/**
 *------------------------------------------------------------------------------
 * API Announcement Route
 *------------------------------------------------------------------------------
 *
 * Handles the API routes.
 *
 */

Route::group(['prefix' => 'v1'], function () {
    Route::get('announcements/all', 'AnnouncementController@getAll')->name('announcements.all');

    Route::get('announcements/find', 'AnnouncementController@postFind')->name('announcements.find');
    Route::get('announcements/search', 'AnnouncementController@postFind')->name('announcements.search');

    Route::get('announcements/{announcement}', 'AnnouncementController@getShow')->name('announcements.show');
});
