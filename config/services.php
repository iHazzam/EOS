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
    'botman' => [
        'facebook_token' => 'EAAbJRtvJhZB0BACrZBceJfCmMF3SPYkXiW10Er1VkqtbGAJI57rNZBbN2bOkWiuXFHip77mK7FEATdB09WFtru0dMQDXgPRbSyk4XPXAR0qfJsbQJc5qifyyMfVVVdhO6NVDMZAHQNid3rcNBvXkJ5pwgYIGsg9RwiHoiKnZCRQZDZD',
        'facebook_app_secret' => 'harry_messenger_playdale_webhook', // Optional - this is used to verify incoming API calls,
    ],

];
