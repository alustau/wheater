<?php
namespace App\Contracts\Services\Converter;


interface Factorable
{
    public function converter($name): Convertible;
}
