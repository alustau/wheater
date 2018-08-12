<?php
namespace App\Services\Converter;


use App\Contracts\Services\Converter\Convertible;
use App\Contracts\Services\Converter\Factorable;
use App\Exceptions\Converter\ConverterNotFoundException;
use App\Services\Converter\Type\Celsius;
use App\Services\Converter\Type\Fahrenheit;

class Factory implements Factorable
{
    protected $converters = [
        'Fahrenheit' => Fahrenheit::class,
        'Celsius'    => Celsius::class
    ];

    public function converter($name): Convertible
    {
        if (! isset($this->converters[$name])) {
            throw new ConverterNotFoundException($name);
        }

        return new $this->converters[$name];
    }
}
