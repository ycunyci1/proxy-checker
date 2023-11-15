<?php

namespace App\Services;

interface HttpClientServiceInterface
{
    public function addRequestToPromises(string $proxy, string $type, array &$promises, &$timing): array;
}
