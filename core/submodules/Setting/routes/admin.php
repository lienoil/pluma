<?php

Route::group(['prefix' => 'settings'], function () {
    Route::get('general', 'GeneralSettingController@index')->name('settings.general');
    Route::post('general', 'GeneralSettingController@store')->name('settings.general.store');

    Route::get('social', 'SettingController@getSocialForm')->name('settings.social');
    Route::post('store', 'SettingController@store')->name('settings.store');
});
