<?php
namespace App\Contracts\Repositories;


use App\Contracts\Services\Converter\Scalable;

interface Scale
{
    public function get($name): Scalable;
}
