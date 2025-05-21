<?php

namespace App\Traits;

trait EnumToArrayTrait
{
    /**
     * @return array
     */
    public static function namesArray(): array
    {
        return array_column(self::cases(), 'name');
    }

    /**
     * @return array
     */
    public static function valuesArray(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * @return array
     */
    public static function casesArray(): array
    {
        return array_combine(self::valuesArray(), self::namesArray());
    }
}
