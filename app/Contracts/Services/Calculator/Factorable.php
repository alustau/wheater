<?php
namespace App\Contracts\Services\Calculator;


interface Factorable
{
    public function calculator($name): Calculable;
}
