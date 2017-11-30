<?php

Route::group(['prefix' => 'settings'], function () {
    Route::get('general', 'Setting\Controllers\SettingController@getGeneralForm')->name('settings.general');
    Route::get('social', 'Setting\Controllers\SettingController@getSocialForm')->name('settings.social');
    Route::post('store', 'Setting\Controllers\SettingController@store')->name('settings.store');
});
