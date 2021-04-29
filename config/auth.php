<?php

return [

    'defaults' => [
        'guard' => 'cms', // la guard di default
        'passwords' => 'cms_users', //le opzioni per il reset della password
    ],

    //le varie guard disponibili nell'applicazione (una per il web e una per le api)
    'guards' => [
        'cms' => [
            'driver' => 'session', //si basa sul cookie del browser con il sessionId
            'provider' => 'cms_users', //il provider vedere sotto fra i provider
        ],

        'web' => [
            'driver' => 'session', //si basa sul cookie del browser con il sessionId
            'provider' => 'users', //il provider vedere sotto fra i provider
        ],

        'api' => [
            'driver' => 'token', //si basa sul token dato che non c'è il browser
            'provider' => 'cms_users', //stesso provider di quello del web
            'hash' => false,
        ],
    ],

    'providers' => [
        'cms_users' => [
            'driver' => 'eloquent',
            'model' => App\Models\UserCms::class, //il Model per le cradenziali
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | You may specify multiple password reset configurations if you have more
    | than one user table or model in the application and you want to have
    | separate password reset settings based on the specific user types.
    |
    | The expire time is the number of minutes that the reset token should be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    */

    'passwords' => [
        'cms_users' => [
            'provider' => 'cms_users',
            'table' => 'password_cms_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Here you may define the amount of seconds before a password confirmation
    | times out and the user is prompted to re-enter their password via the
    | confirmation screen. By default, the timeout lasts for three hours.
    |
    */

    'password_timeout' => 10800,

];
