<?php

namespace App\Enums;

enum ProductStatus: string
{
    case DRAFT = 'draft';
    case PENDING = 'pending';
    case PUBLISHED = 'published';

    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }
}
