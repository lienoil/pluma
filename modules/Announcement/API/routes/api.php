<?php

Route::delete('announcements/destroy/{announcement}', 'Announcement\API\Controllers\AnnouncementController@destroy')->name('announcements.destroy');
Route::delete('announcements/delete/{announcement}', 'Announcement\API\Controllers\AnnouncementController@delete')->name('announcements.delete');
Route::get('announcements/all', 'Announcement\API\Controllers\AnnouncementController@all')->name('announcements.all');
Route::get('announcements/search', 'Announcement\API\Controllers\AnnouncementController@search')->name('announcements.search');
Route::get('announcements/trash/all', 'Announcement\API\Controllers\AnnouncementController@getTrash')->name('announcements.trash.all');
Route::post('announcements/{announcement}/clone', 'Announcement\API\Controllers\AnnouncementController@clone')->name('announcements.clone');
Route::post('announcements/{announcement}/restore', 'Announcement\API\Controllers\AnnouncementController@restore')->name('announcements.restore');
