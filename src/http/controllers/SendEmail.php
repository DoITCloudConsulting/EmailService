<?php

namespace Doitcloud\EmailService\Http\Controllers;

use Doitcloud\EmailService\Http\Controllers\ConnectedAppMicrosoft;
use GuzzleHttp\Client;

class SendEmail
{
    public $subject;
    public $contentType;
    public $content;
    public $recipients = [];

    public function send()
    {
        $connectedAppMicrosoft = new ConnectedAppMicrosoft();
        $accessToken = $connectedAppMicrosoft->connectApp();


        $client = new Client();

        $response = $client->post(config('emailservice.send_email_url'), [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'message' => [
                    'subject' =>$this->subject,
                    'body' => [
                        'contentType' => $this->contentType,
                        'content' => $this->content,
                    ],
                    'toRecipients' => [
                        [
                            'emailAddress' => $this->recipients
                            // [
                            //     'address' => 'hugo@doitcloud.consulting',
                            // ],
                        ],
                    ],
                ],
            ]
        ]);
    }
}
