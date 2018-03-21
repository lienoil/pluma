<?php

use Page\Models\Page;
use Test\Events\MessagePosted;

Route::get('testsx/broadcast', function () {
    $message = Page::first();
    broadcast(new MessagePosted($message, user()));

    return 1;
});

Route::resource('socket', 'SocketController');

Route::resource('tests', 'TestController');
