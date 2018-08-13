<?php
namespace App\Services\Converter\Type;

use App\Contracts\Services\Converter\Convertible;
use App\Contracts\Services\Converter\Scalable;
use App\Services\Converter\Formula;

class Fahrenheit implements Convertible
{
    public function convert(Scalable $from, $value)
    {
        $kelvin = Formula::apply($from->formula(), $value);

        return ($kelvin * 1.8) - 459.889;
    }
}
