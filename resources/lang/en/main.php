<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Main Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used all across the panel
    |
    */

    'home' => 'Home',
    'dashboard' => 'Dashboard',
    'apps' => [
        'news' => 'News',
        'shop' => 'Shop',
        'donate' => 'Donate',
        'vote' => 'Vote',
        'services' => 'Ingame Services',
        'ranking' => 'Ranking',
        'manage' => 'Ingame Management',
        'system' => 'System',
        'members' => 'Members'
    ],
    'acp_link' => 'Admin Control Panel',
    'acc_settings' => 'Account Settings',
    'select_character' => 'Select a Character',
    'site' => 'Go to Site',

    /* Login/Register Language Lines */
    'login' => 'Login',
    'login_link' => 'Login | Register',
    'logout' => 'Log Out',
    'signin' => [
        'title' => 'Sign In',
        'error' => 'Enter any username and password.',
        'username' => 'Username',
        'password' => 'Password',
        'button' => 'Login',
        'create' => 'Create Account',
    ],
    'signup' => [
        'title' => 'Sign Up',
        'info' => 'Enter your account details below:',
        'email' => 'Email',
        'username' => 'Username',
        'password' => 'Password',
        'confirm' => 'Re-type Your Password',
        'submit' => 'Submit',
        'back' => 'Back',
    ],

    'no_results' => 'Sorry, but there\'s nothing to display...',
    'acc_balance' => 'Balance: :money AP',
    'buy' => 'Buy',
    'no_character_selected' => 'You must select a character before proceeding.',
    'no_characters' => 'You haven\'t created any characters.',
    'not_enough' => 'You don\'t have enough :currency.',
    'not_enough_gold' => 'You don\'t have enough gold.',

    'submit' => 'Submit',
    'save' => 'Save',
    'save_settings' => 'Save Settings',
    'settings' => 'Settings',
    'account' => 'Account',
    'edit' => 'Edit',
    'remove' => 'Remove',
    'loading' => 'Loading...',
    'settings_saved' => 'Your settings have been saved!',

    'cron' => [
        'add' => 'Automate Your Panel',
        'info' => 'Adding this cron job will automate ranking system updates.',
        'job' => '* * * * * php ' . base_path( 'artisan' ) . ' schedule:run >> /dev/null 2>&1'
    ],

    'acc_tabs' => [
        'overview' => [
            'title' => 'Overview',
            'fields' => [
                'name' => 'Name',
                'email' => 'Email',
                'password' => 'Password'
            ]
        ],
        'email' => [
            'title' => 'Email Address',
            'fields' => [
                'email' => 'Email Address'
            ]
        ],
        'password' => [
            'title' => 'Password',
            'fields' => [
                'current' => 'Current Password',
                'current_desc' => 'To ensure this change is secure',
                'new' => 'New Password',
                'confirm' => 'Confirm New Password'
            ]
        ]
    ],

    '404' => [
        'title' => 'Houston, we have a problem.',
        'content' => 'Actually, the page you are looking for does not exist.',
        'button' => 'Return home'
    ],
    '500' => [
        'title' => 'Oops! Something went wrong.',
        'content' => 'We are fixing it! Please come back in a while.',
        'button' => 'Return home'
    ]

];
