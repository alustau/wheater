<?php
namespace App\Contracts\Services\Calculator;


interface Calculable
{
    public function calculate($data): Resultable;
}
