<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;

interface ProxyCheckServiceInterface
{
    public function check(string $data): array;

    public function checkProcess(array $data): Collection|array;

    public function keyGenerate(): string;

    public function createProxyResultsFromResponses(array $results, array $timing, string $key): void;
}
