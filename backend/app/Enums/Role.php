<?php

namespace App\Enums;

enum Role: string
{
    case ADMIN = 'admin';
    case EDITOR = 'editor';
    case CUSTOMER = 'customer';

    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }
}
