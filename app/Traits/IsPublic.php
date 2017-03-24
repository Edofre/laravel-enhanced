<?php

namespace App\Traits;

/**
 * Class IsPublic
 * @package App\Traits
 */
trait IsPublic
{
    /**
     * @return static
     */
    public static function all_public()
    {
        return self::all()->where('is_public', true);
    }
}