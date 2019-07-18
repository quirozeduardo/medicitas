<?php

return [
    'user' => [
        'model' => 'App\User',
    ],
    'broadcast' => [
        'enable' => false,
        'app_name' => env('APP_NAME','Laravel'),
        'pusher' => [
            'app_id' => env('PUSHER_APP_ID',''),
            'app_key' => env('PUSHER_APP_KEY',''),
            'app_secret' => env('PUSHER_APP_SECRET',''),
            'options' => [
                'cluster' => 'ap1',
                'encrypted' => true
            ]
        ],
    ],
];
