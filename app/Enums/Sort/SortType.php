<?php

namespace App\Enums\Sort;

enum SortType
{
    case Asc;
    case Desc;

    public static function fromName(string $name)
    {
        foreach (self::cases() as $status) {
            if( $name === strtolower($status->name) ){
                return $status;
            }
        }
    }
}