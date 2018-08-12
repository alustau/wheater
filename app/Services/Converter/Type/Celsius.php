<?php
namespace App\Services\Converter\Type;

use App\Contracts\Services\Converter\Convertible;
use App\Contracts\Services\Converter\Scalable;
use App\Services\Converter\Formula;

class Celsius implements Convertible
{
    public function convert(Scalable $from, $value)
    {
        $kelvin = Formula::apply($from->formula(), $value);

        return $kelvin - 273.15;
    }
}
