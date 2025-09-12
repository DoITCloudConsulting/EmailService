<?php

namespace Doitcloud\EmailService\Http\Controllers;

use GuzzleHttp\Client;

class ConnectedAppMicrosoft
{


    public function connectApp()
    {
        $client = new Client();

        $response = $client->post( config('emailservice.login_domain') . config('emailservice.tenant_id') . config('emailservice.path'), [
            'form_params' => [
                'client_id' => config('emailservice.client_id'),
                'client_secret' => config('emailservice.client_secret'),
                'scope' => config('emailservice.scope'),
                'grant_type' => 'client_credentials',
            ]
        ]);

        $body = json_decode((string) $response->getBody(), true);

        return $body['access_token'] ?? null;
    }
}
