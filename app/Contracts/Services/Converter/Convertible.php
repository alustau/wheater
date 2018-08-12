<?php
namespace App\Contracts\Services\Converter;


interface Convertible
{
    public function convert(Scalable $from, $value);
}
