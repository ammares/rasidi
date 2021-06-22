<?php
return [
    'email_from'                    => env('MAIL_FROM_ADDRESS', 'no_reply@miniandmore.co'),

    'name_from'                     => env('MAIL_FROM_NAME', 'No Reply'),

    // supported services: sendgrid; empty for normal smpt
    'mail_service'                  => env('MAIL_SERVICE', ''),

    // required if mail_service => sendgrid
    'sendgrid_api_key'              => env('SENDGRID_API_KEY', ''),

    'prefix_url'                    => 'component-notification',

    'users_table'                   => 'users',

    'show_views'                    => true,

    'slack' => [
        'slack_webhook_url'         => 'https://hooks.slack.com/services/...',//https://hooks.slack.com/services/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

        'image'                     => 'https://laravel.com/favicon.png',

        'app_name'                  => 'No-Reply',

        'channel'                   => '#.....',
    ],

    'middleware'                    => ['web','auth']
];
