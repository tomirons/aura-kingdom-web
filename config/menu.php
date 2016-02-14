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
        'shop' => 'basket',
        'donate' => 'credit-card',
        'voucher' => 'tag',
        'vote' => 'like',
        'services' => 'magic-wand',
        'ranking' => 'bar-chart',
        'management' => 'users'
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
            'view',
            'settings'
        ],
        'donate' => [
            'application' => TRUE,
            'settings'
        ],
        'vote' => [
            'application' => TRUE,
            'create',
            'view'
        ],
        'ranking' => [
            'application' => TRUE,
            'settings'
        ],
    ]
];
