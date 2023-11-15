<?php

declare(strict_types=1);

namespace App\Services;

class FormattingProxiesService
{
    public static function getFormattedProxiesGroupsArr(string $proxies, int $countInOneGroup): array
    {
        $proxiesArr = explode("\n", $proxies);
        $proxiesArr = array_map(function ($proxy) {
            return preg_replace('/\s+/', '', $proxy);
        }, $proxiesArr);
        $proxiesArr = array_unique($proxiesArr);

        return ['array' => array_chunk($proxiesArr, $countInOneGroup), 'count' => count($proxiesArr)];
    }
}
