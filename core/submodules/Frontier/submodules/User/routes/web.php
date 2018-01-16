<?php

/**
 *------------------------------------------------------------------------------
 * Login/logout route
 *------------------------------------------------------------------------------
 *
 * The route of the authentication links.
 *
 */

Route::get('login', 'LoginController@showLoginForm')->name('login.show');
Route::post('login', 'LoginController@login')->name('login.login');

Route::get('logout', 'LoginController@logout')->name('logout.logout');
Route::post('logout', 'LoginController@logout')->name('logout.logout');

Route::get('register', 'RegisterController@showRegistrationForm')->name('register.show');
Route::post('register', 'RegisterController@register')->name('register.register');
Route::get('registered', 'RegisterController@showRegisteredPage')->name('register.registered');

/**
 *------------------------------------------------------------------------------
 * Password reset route
 *------------------------------------------------------------------------------
 *
 * The route of the password recovery pages.
 *
 */

Route::group(['prefix' => 'account'], function () {
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.send');
    // Route::get('password/sent', 'ForgotPasswordController@sent')->name('password.sent');
    Route::get('password/reset/{token?}', 'ResetPasswordController@showResetForm')->name('password.token');
    Route::post('password/reset', 'ResetPasswordController@reset')->name('password.reset');
});

Route::get('email', function () {
	set_time_limit(60);
	$user = \User\Models\User::find(1);
	$mail = new \User\Notifications\EmailVerification($user);

	Mail::to('john.dionisio1@gmail.com')->send($mail);

	return $mail;

	return "done";
});
