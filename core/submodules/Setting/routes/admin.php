<?php

Route::group(['prefix' => 'settings'], function () {
    Route::get('general', '\Setting\Controllers\SettingController@getGeneralForm')->name('settings.general.form');
});
