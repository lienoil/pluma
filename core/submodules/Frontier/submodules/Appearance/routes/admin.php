<?php

/**
 * Appearance Menu
 *
 */
Route::group(['prefix' => 'appearance'], function () {
    Route::resource('menus', '\Frontier\Controllers\MenuController');
});
