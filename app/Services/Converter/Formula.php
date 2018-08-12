<?php
namespace App\Services\Converter;


use App\Contracts\Services\Converter\Formulable;

class Formula implements Formulable
{
    public static function apply($formula, $value)
    {
        eval(str_replace('x', $value, (string) $formula));

        return isset($temperature) ? $temperature : null;
    }
}
