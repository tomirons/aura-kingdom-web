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
            'role' => 'manage-system',
            'apps',
            'settings'
        ],
        'news' => [
            'role' => 'manage-articles',
            'application' => true,
            'create',
            'view'
        ],
        'donate' => [
            'role' => 'change-donate-settings',
            'application' => true,
            'settings'
        ],
        'vote' => [
            'role' => 'manage-vote-sites',
            'application' => true,
            'create',
            'view'
        ],
        'members' => [
            'role' => 'manage-users',
            'manage'
        ]
    ]
];
