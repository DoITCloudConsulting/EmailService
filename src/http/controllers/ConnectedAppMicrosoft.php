<?php

namespace Doitcloud\EmailMicrosoftServices\Http\Controllers;

use GuzzleHttp\Client;

class ConnectedAppMicrosoft
{

    public $tenantId = '25596fbb-603c-46b2-9ae1-a967e162a2ff';
    public $clientId = '9f6e759b-3842-4152-8534-26e217cf4d62';
    public $clientSecret = '-qv8Q~lt41QcTlIspxMQifMdBMG0kia1~myfib.L';
    public $scope = 'https://graph.microsoft.com/.default';

    public function connectApp()
    {
        $client = new Client();

        $response = $client->post("https://login.microsoftonline.com/" . $this->tenantId . "/oauth2/v2.0/token", [
            'form_params' => [
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
                'scope' => $this->scope,
                'grant_type' => 'client_credentials',
            ]
        ]);

        $body = json_decode((string) $response->getBody(), true);

        return $body['access_token'] ?? null;
    }
}
