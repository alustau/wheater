<?php
namespace App\Contracts\Services\Converter;


interface Formulable
{
    public static function apply($formula, $value);
}
