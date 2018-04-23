<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
//    'facebook' => [
//        'client_id'     => '1664953663620261',
//        'client_secret' => '1e1c870ff5261c5a8706a20cf3f8d171',
//        'redirect'      => 'http://toanphat.local/auth/facebook/callback',
//    ],
    'facebook' => [
        'client_id'     => '2106174216326218',
        'client_secret' => '1c151bf823ba993c9caae2408b1d3ab1',
        'redirect'      => 'https://ngthanh.pack4djs:6969/auth/facebook/callback',
    ],
];
