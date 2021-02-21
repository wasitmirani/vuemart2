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
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'meta' => [
        'meta_title' => env('META_TITLE', ''),
        'meta_description' => env('META_DESCRIPTION', ''),
        'meta_keyword' => env('META_KEYWORD', ''),
        'Is_seoTags' => env('SEOTAGS', '0')
    ],
    'google' => [
        'client_id' => env('GOOGLE_client_id'),
        'client_secret' => env('GOOGLE_client_secret'),
        'redirect' => env('GOOLE_callBack'),
    ],

];
