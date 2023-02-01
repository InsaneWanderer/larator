<?php

namespace App\Enums\Advert;

enum AdvertType
{
    case Sell;
    case Rent;

    public function ru()
    {
        return match ($this) {
            self::Sell => "Продажа",
            self::Rent => "Аренда",
        };
    }

    public static function casesString() : array
    {
        $arr = [];
        foreach (self::cases() as $case) {
            $arr[] = $case->name;
        }
        return $arr;
    }

    public static function fromName(string $name)
    {
        foreach (self::cases() as $status) {
            if( $name === $status->name){
                return $status;
            }
        }
    }
}