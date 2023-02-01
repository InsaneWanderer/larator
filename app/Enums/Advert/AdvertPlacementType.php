<?php

namespace App\Enums\Advert;

enum AdvertPlacementType
{
    case House;
    case Flat;
    case Room;

    public function ru()
    {
        return match ($this)
        {
            self::House => "Дом",
            self::Flat => "Квартира",
            self::Room => "Комната",
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

    public static function fromName(string $name): self
    {
        foreach (self::cases() as $status) {
            if( $name === strtolower($status->name) ){
                return $status;
            }
        }
    }
}