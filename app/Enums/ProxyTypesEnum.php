<?php

declare(strict_types=1);

namespace App\Enums;

enum ProxyTypesEnum
{
    case socks5;
    case https;
    case http;

    public static function toArray(): array
    {
        $arrCases = [];
        foreach (self::cases() as $case) {
            $arrCases[] = $case->name;
        }

        return $arrCases;
    }
}
