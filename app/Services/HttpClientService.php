<?php

declare(strict_types=1);

namespace App\Services;

use GuzzleHttp\Client;

class HttpClientService implements HttpClientServiceInterface
{
    protected string $service = 'http://ip-api.com/json?fields=country,query';

    protected Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * Добавить асинхронный запрос в группу на проверку прокси
     */
    public function addRequestToPromises(string $proxy, string $type, array &$promises, &$timing): array
    {
        $proxyUrl = "$type://{$proxy}";
        $start = now();
        $promises[$proxy] = $this->client->getAsync($this->service, [
            'proxy' => $proxyUrl,
            'timeout' => 15,
        ])->then(
            function ($response) use ($type, $timing, $proxy, $start) {
                $end = now();
                $timing[$proxy] = $end->diffInMilliseconds($start);
                $data = json_decode($response->getBody()->getContents(), true);
                $data['type'] = $type;

                return $data;
            },
            function ($exception) use ($proxy, &$promises) {
                if (! array_key_exists($proxy, $promises)) {
                    return null;
                }

                return $promises[$proxy];
            }
        );

        return $promises;
    }
}
