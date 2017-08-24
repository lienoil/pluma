<?php

Route::group(['prefix' => 'settings'], function () {
    Route::get('general', '\Setting\Controllers\SettingController@getGeneralForm')->name('settings.general');
    Route::get('themes', '\Setting\Controllers\SettingController@getThemesForm')->name('settings.themes');

    Route::post('store', '\Setting\Controllers\SettingController@store')->name('settings.store');
});
