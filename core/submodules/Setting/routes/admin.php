<?php

Route::group(['prefix' => 'settings'], function () {
    // Settings
    Route::get('/', function () {
        return redirect()->route('settings.general');
    })->name('settings');

    Route::post('store', 'SettingController@store')->name('settings.store');

    // General
    Route::get('general', 'GeneralSettingController@index')->name('settings.general');
    Route::post('general', 'GeneralSettingController@store')->name('settings.general.store');

    // Display
    Route::get('display', 'DisplaySettingController@index')->name('settings.display');
    Route::post('display', 'DisplaySettingController@store')->name('settings.display.store');
    Route::get('writing', 'GeneralSettingController@index')->name('settings.writing');

    // Branding
    Route::get('branding', 'BrandingSettingController@index')->name('settings.branding');
    Route::post('branding', 'BrandingSettingController@store')->name('settings.branding.store');

    // Email
    Route::get('email', 'EmailSettingController@index')->name('settings.email');
    Route::post('email', 'EmailSettingController@store')->name('settings.email.store');

    // Social
    Route::get('social', 'SettingController@getSocialForm')->name('settings.social');

    // Theming
    Route::get('theming', 'ThemingSettingController@index')->name('settings.theming');
    Route::post('theming', 'ThemingSettingController@store')->name('settings.theming.store');

    // System
    Route::get('system', 'SystemSettingController@index')->name('settings.system');
    Route::post('system', 'SystemSettingController@store')->name('settings.system.store');
});
