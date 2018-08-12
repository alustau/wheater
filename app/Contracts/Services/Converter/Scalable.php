<?php
namespace App\Contracts\Services\Converter;


interface Scalable
{
    public static function set($data): Scalable;

    public function name();

    public function formula();
}
