<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Members Language Lines
    |--------------------------------------------------------------------------
    */
    'manage' => 'Manage',
    'balance' => 'Give AP to :member',
    'permissions' => 'Changing permissions for :member',
    'success' => [
        'balance' => ':user received :count AP',
        'permissions' => ':user is now a :role'
    ],
    'table' => [
        'id' => 'ID',
        'name' => 'Name',
        'balance' => 'Aura Points',
        'joined' => 'Joined On',
        'actions' => 'Actions'
    ],
    'actions' => [
        'give' => 'Give AP',
        'permissions' => 'Change Permissions'
    ],
    'fields' => [
        'amount' => [
            'label' => 'Amount to give',
        ],
        'role' => [
            'label' => 'Role'
        ],
        'search' => [
            'placeholder' => 'Search...'
        ]
    ],
    'roles' => [
        'admin' => 'Administrator',
        'mod' => 'Moderator',
        'member' => 'Member'
    ]

];
