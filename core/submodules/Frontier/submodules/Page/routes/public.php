<?php

/**
 * -----------------------------------------------------------------------------
 * Main Public Route
 * -----------------------------------------------------------------------------
 *
 * Handles the public facing routes, e.g. Home, About Us, etc.
 *
 */

Route::get('{slug?}', 'PageController@single')
     ->name('page.single')
     ->where('slug', '.*');
