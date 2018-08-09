<?php
namespace App\Contracts\Repository;


interface Prediction
{
    public function getAllByCityName($name);
}
