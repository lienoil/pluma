<?php

Route::group(['prefix' => 'settings'], function () {
    Route::get('general', 'SettingController@getGeneralForm')->name('settings.general');
    Route::get('social', 'SettingController@getSocialForm')->name('settings.social');

    Route::post('store', 'SettingController@store')->name('settings.store');
});
