<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'mailtrap' => [
        'transport' => 'smtp',
        'host' => env('MAILTRAP_HOST'),
        'port' => env('MAILTRAP_PORT'),
        'encryption' => env('MAILTRAP_ENCRYPTION', 'tls'),
        'username' => env('MAILTRAP_USERNAME'),
        'password' => env('MAILTRAP_PASSWORD'),
    ],

    'gmail' => [
        'transport' => 'smtp',
        'host' => env('GMAIL_HOST', 'smtp.gmail.com'),
        'port' => env('GMAIL_PORT', 587),
        'encryption' => env('GMAIL_ENCRYPTION', 'tls'),
        'username' => env('GMAIL_USERNAME'),
        'password' => env('GMAIL_PASSWORD'),
    ],

];
