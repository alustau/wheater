<?php
namespace App\Services\Converter;

use App\Contracts\Services\Converter\Convertible;
use App\Contracts\Services\Converter\Scalable;

class Celsius implements Convertible
{
    public function convert(Scalable $from, $value)
    {
        $temperature = Formula::apply($from->formula(), $value);

        return $temperature - 273.15;
    }
}
