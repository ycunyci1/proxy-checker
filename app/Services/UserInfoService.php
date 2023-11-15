<?php

declare(strict_types=1);

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class UserInfoService
{
    /**
     * @throws GuzzleException
     */
    public function getIp()
    {
        $client = new Client();
        $response = $client->get('https://api.ipify.org?format=json');
        $data = json_decode($response->getBody());

        return $data->ip;
    }
}
