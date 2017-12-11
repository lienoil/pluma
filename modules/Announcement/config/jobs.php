<?php

return [
    ['job' => Announcement\Jobs\PublishAnnouncement::class, 'queue' => null],
    ['job' => Announcement\Jobs\DeleteAnnouncement::class, 'queue' => null],
];
