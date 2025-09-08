<?php

return [
    'tenant_id'     => env('ES_TENANT_ID', ''),
    'client_id'     => env('ES_CLIENT_ID', ''),
    'client_secret' => env('ES_CLIENT_SECRET', ''),
    'scope'         => env('ES_SCOPE', ''),
    'login_domain'  => env('ES_LOGIN_DOMAIN', ''),
    'path'          => env('ES_PATH', ''),
    'send_email_url'=> env('ES_SEND_EMAIL_URL', 'https://graph.microsoft.com/v1.0/users/53ae6ece-0441-462e-bfcc-f4b9fa8a13f4/sendMail')
];
