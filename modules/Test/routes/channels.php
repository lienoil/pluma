<?php

Broadcast::channel('message-posted', function ($message, $user) {
    return true; # muna, ha?
});
