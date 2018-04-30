<?php
/**
 * Ngan luong service config
 */
return [
    'service' => [
        'merchant_code'        => env('BUDGET_MERCHANT_CODE'),
        'merchant_pass'        => env('BUDGET_MERCHANT_PASS'),
        'merchant_url_connect' => env('BUDGET_URL_CONNECT'),
        'email_receiver'       => env('BUDGET_EMAIL_RECEIVER')
    ],
];
