<?php

Broadcast::channel('presence-chatbox', function ($user) {
    return ['id' => $user->id, 'displayname' => $user->displayname]; # muna, ha?
});

Broadcast::channel('chatbox', function ($user) {
    return ['id' => $user->id, 'displayname' => $user->displayname];
});
