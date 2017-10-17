<?php

return [
    'accepted' => [
        'image/gif',
        'image/jpeg',
        'image/jpg',
        'image/png',
        'image/svg',
    ],

    'icons' => [
        'application/zip' => 'fa-file-archive-o',
        'application/rar' => 'fa-file-archive-o',

        'image/png' => 'insert_photo',
        'image/jpeg' => 'insert_photo',
        'image/jpg' => 'insert_photo',

        'audio/mpeg' => 'music_note',
        'audio/mp3' => 'music_note',
    ],

    'thumbnails' => [
        'application/zip' => "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mPMSPH7DwAEcQIbHJh16wAAAABJRU5ErkJggg==",
        'application/rar' => "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mPMSPH7DwAEcQIbHJh16wAAAABJRU5ErkJggg==",

        'audio/mpeg' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mO8HbDpPwAGyQLeSVLtbwAAAABJRU5ErkJggg==',
        'audio/mp3' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mO8HbDpPwAGyQLeSVLtbwAAAABJRU5ErkJggg==',
    ]
];
