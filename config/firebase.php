<?php

return [

    'credentials' => [
        'file' => json_decode(env('FIREBASE_CREDENTIALS', true)),
    ],

    'database' => [
        'url' => env('FIREBASE_DATABASE_URL'),
    ],

];
