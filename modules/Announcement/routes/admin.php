<?php

Route::delete('announcements/delete/many', 'AnnouncementManyController@delete')->name('announcements.many.delete');
Route::delete('announcements/delete/{announcement}', 'AnnouncementController@delete')->name('announcements.delete');
Route::delete('announcements/destroy/many', 'AnnouncementManyController@destroy')->name('announcements.many.destroy');
Route::get('announcements/refresh', 'AnnouncementRefreshController@index')->name('announcements.refresh.index');
Route::get('announcements/trash', 'AnnouncementController@trash')->name('announcements.trash');
Route::post('announcements/refresh', 'AnnouncementRefreshController@refresh')->name('announcements.refresh.refresh');
Route::post('announcements/restore/many', 'AnnouncementManyController@restore')->name('announcements.many.restore');
Route::post('announcements/{announcement}/restore', 'AnnouncementController@restore')->name('announcements.restore');
Route::resource('announcements', 'AnnouncementController');
