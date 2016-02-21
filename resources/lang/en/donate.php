<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Donate Language Lines
    |--------------------------------------------------------------------------
    */

    'paypal_title' => 'PayPal',
    'paymentwall_title' => 'Paymentwall',
    'no_methods' => 'Donation methods haven\'t been setup yet, please contact an administrator.',
    'error' => [
        'title' => 'Error',
        'message' => 'Please enter the dollar amount you would like to donate <b>OR</b> the amount of :currency you would like to receive.',
        'minimum' => 'You can\'t donate less than :min.'
    ],
    'double_notice' => '<b>Notice:</b> Double donation is active!',

    'double_donation' => 'Double Donation',
    'paypal_currency' => 'Paypal Currency',
    'paypal_client_id' => 'Client ID',
    'paypal_client_id_desc' => 'To obtain a client ID and secret, <a href="https://remoteservices.invisionpower.com/docs/paypal_developer/?version=101023" target="_blank">create an application on PayPal\'s developer site</a>. Make sure you use the <strong>live credentials</strong>, not the sandbox credentials.',
    'paypal_secret' => 'Secret',
    'paypal_per' => 'Currency per :currency',
    'paypal_min' => 'Minimum Amount',
    'paypal' => [
        'description' => ':amount Aura Points',
        'success' => 'Thank you for supporting our server, we appreciate your donation.'
    ],
    'paymentwall_app_key' => 'Application Key',
    'paymentwall_key' => 'Secret Key',
    'paymentwall_link' => 'iFrame Link',
    'paymentwall_setup' => [
        'title' => 'How to Setup Paymentwall',
        'steps' => [
            1 => 'Login to Paymentwall',
            2 => 'Edit application settings',
            3 => 'Change pingback type to URL',
            4 => 'Change URL to :url',
            5 => "<i class=\"icon-info font-red\"></i> Set PINGBACK SIGNATURE VERSION to '1'"
        ]
    ],
    'currency' => [
        'AUD'   => "Australian Dollar",
        'BRL'   => "Brazilian Real",
        'CAD'   => "Canadian Dollar",
        'CZK'   => "Czech Koruna",
        'DKK'   => "Danish Krone",
        'EUR'   => "Euro",
        'HKD'   => "Hong Kong Dollar",
        'HUF'   => "Hungarian Forint",
        'ILS'   => "Israeli New Sheqel",
        'JPY'   => "Japanese Yen",
        'MYR'   => "Malaysian Ringgit",
        'MXN'   => "Mexican Peso",
        'NOK'   => "Norwegian Krone",
        'NZD'   => "New Zealand Dollar",
        'PHP'   => "Philippine Peso",
        'PLN'   => "Polish Zloty",
        'GBP'   => "Pound Sterling",
        'SGD'   => "Singapore Dollar",
        'SEK'   => "Swedish Krona",
        'CHF'   => "Swiss Franc",
        'TWD'   => "Taiwan New Dollar",
        'THB'   => "Thai Baht",
        'TRY'   => "Turkish Lira",
        'USD'   => "U.S. Dollar",
    ]

];
