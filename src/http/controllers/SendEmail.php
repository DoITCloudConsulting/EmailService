<?php

namespace Doitcloud\EmailMicrosoftServices;

use Doitcloud\EmailMicrosoftServices\Http\Controllers\ConnectedAppMicrosoft;

class SendEmail
{
    public function send()
    {
        $connectedAppMicrosoft = new ConnectedAppMicrosoft();
        $accessToken = $connectedAppMicrosoft->connectApp();
        echo $accessToken;
    }
}
