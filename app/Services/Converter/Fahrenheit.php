<?php
namespace App\Services\Converter;

use App\Contracts\Services\Converter\Convertible;
use App\Contracts\Services\Converter\Scalable;

class Fahrenheit implements Convertible
{
    public function convert(Scalable $from, $value)
    {
        $temperature = Formula::apply($from->formula(), $value);

        return ($temperature * 1.8) - 459.889;
    }
}
