<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Admin Menu
    |--------------------------------------------------------------------------
    */

    'icons' => [
        'dashboard' => 'home',
        'system' => 'settings',
        'members' => 'user',
        'news' => 'book-open',
        'donate' => 'credit-card',
        'vote' => 'like',
        'ranking' => 'bar-chart',
    ],

    'admin' => [
        'dashboard',
        'system' => [
            'apps',
            'settings'
        ],
        'members' => [
            'manage'
        ],
        'news' => [
            'application' => TRUE,
            'create',
            'view'
        ],
        'donate' => [
            'application' => TRUE,
            'settings'
        ],
        'vote' => [
            'application' => TRUE,
            'create',
            'view'
        ]
    ]
];
