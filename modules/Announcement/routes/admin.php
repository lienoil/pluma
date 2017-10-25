<?php

Route::delete('announcements/delete/many', 'Announcement\Controllers\AnnouncementManyController@delete')->name('announcements.many.delete');
Route::delete('announcements/delete/{announcement}', 'Announcement\Controllers\AnnouncementController@delete')->name('announcements.delete');
Route::delete('announcements/destroy/many', 'Announcement\Controllers\AnnouncementManyController@destroy')->name('announcements.many.destroy');
Route::get('announcements/refresh', 'Announcement\Controllers\AnnouncementRefreshController@index')->name('announcements.refresh.index');
Route::get('announcements/trash', 'Announcement\Controllers\AnnouncementController@trash')->name('announcements.trash');
Route::post('announcements/refresh', 'Announcement\Controllers\AnnouncementRefreshController@refresh')->name('announcements.refresh.refresh');
Route::post('announcements/restore/many', 'Announcement\Controllers\AnnouncementManyController@restore')->name('announcements.many.restore');
Route::post('announcements/{announcement}/restore', 'Announcement\Controllers\AnnouncementController@restore')->name('announcements.restore');
Route::resource('announcements', 'Announcement\Controllers\AnnouncementController');
