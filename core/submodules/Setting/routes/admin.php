<?php

Route::group(['prefix' => 'settings'], function () {
    Route::get('general', 'GeneralSettingController@index')->name('settings.general');
    Route::post('general', 'GeneralSettingController@store')->name('settings.general.store');

    // Branding
    Route::get('branding', 'BrandingSettingController@index')->name('settings.branding');
    Route::post('branding', 'BrandingSettingController@store')->name('settings.branding.store');

    // Theming
    Route::get('theming', 'ThemingSettingController@index')->name('settings.theming');
    Route::post('theming', 'ThemingSettingController@store')->name('settings.theming.store');

    Route::get('social', 'SettingController@getSocialForm')->name('settings.social');
    Route::post('store', 'SettingController@store')->name('settings.store');
});
