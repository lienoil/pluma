<?php

use Course\Mail\CourseRequested;
use Course\Mail\NewCourseRequest;
use Course\Mail\WelcomeNewUser;
use Course\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Page\Models\Page;
use Test\Events\MessagePosted;
use User\Mail\EmailVerification;

// Route::get('testsx/broadcast', function (Request $request) {
//     broadcast(new MessagePosted($request->all(), user()))->toOthers();

//     return response()->json(true);
// });

// Route::post('socket/message', 'SocketController@message')->name('socket.message');

// Route::resource('socket', 'SocketController');

Route::resource('tests', 'TestController');

Route::get('message/send', function () {
    // return new \User\Mail\EmailVerification(user(), csrf_token());

    Log::info("Request cycle without Queues started");
    Mail::to('princessellen0016@yahoo.com')
        ->send(
            new \User\Mail\EmailVerification(user(), csrf_token())
        );
    Log::info("Request cycle without Queues finished");
    return 'yep';
});
