<?php
namespace App\Contracts\Repositories;


interface Prediction
{
    public function getAllByCityName($name);
}
