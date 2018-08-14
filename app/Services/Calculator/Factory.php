<?php
namespace App\Services\Calculator;


use App\Contracts\Services\Calculator\Calculable;
use App\Contracts\Services\Calculator\Factorable;
use App\Exceptions\Calculator\CalculatorNotFoundException;

class Factory implements Factorable
{
    protected $calculators = [
        'City' => City::class
    ];

    public function calculator($name): Calculable
    {
        if (! isset($this->calculators[$name])) {
            throw new CalculatorNotFoundException($name);
        }

        return new $this->calculators[$name];
    }
}