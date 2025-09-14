<?php

namespace Doitcloud\EmailService\Http\Controllers;

use Doitcloud\EmailService\Http\Controllers\ConnectedAppMicrosoft;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;

class SendEmail
{
    public $subject;
    public $contentType;
    public $content;
    public $recipients = [];
    public $relativePath;

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

    public function sendWithAttachment()
    {
        // --- 1. Preparar el archivo adjunto ---
        $filePath = Storage::disk('public')->path($this->relativePath); // Ruta a tu archivo en el servidor

        // Validar que el archivo exista
        if (!file_exists($filePath)) {
            return response()->json(['error' => 'El archivo adjunto no existe.'], 404);
        }

        $fileName = basename($filePath); // Obtiene el nombre del archivo: "factura_septiembre.pdf"
        $fileContent = file_get_contents($filePath); // Lee el contenido del archivo
        $base64Content = base64_encode($fileContent); // Codifica el contenido a base64
        $mimeType = mime_content_type($filePath); // Obtiene el tipo MIME: "application/pdf"


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
                    'attachments' => [
                        [
                            '@odata.type' => '#microsoft.graph.fileAttachment',
                            'name' => $fileName,
                            'contentType' => $mimeType,
                            'contentBytes' => $base64Content
                        ]
                    ]
                ],
            ]
        ]);


    }
}
