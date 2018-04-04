<?php

use Course\Mail\CourseRequested;
use Course\Mail\NewCourseRequest;
use Course\Models\Course;
use Illuminate\Http\Request;
use Page\Models\Page;
use Test\Events\MessagePosted;
use User\Mail\EmailVerification;

Route::get('testsx/broadcast', function (Request $request) {
    broadcast(new MessagePosted($request->all(), user()))->toOthers();

    return response()->json(true);
});

Route::post('socket/message', 'SocketController@message')->name('socket.message');

Route::resource('socket', 'SocketController');

Route::resource('tests', 'TestController');

Route::get('message/send', function () {
    return Mail::to('john.dionisio1@gmail.com')
        ->send(new NewCourseRequest(Course::first(), \Course\Models\User::find(1), "Hey there, Test"));
});
