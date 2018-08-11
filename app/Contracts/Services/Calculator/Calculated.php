<?php
namespace App\Contracts\Services\Calculator;


use Illuminate\Support\Collection;

interface Calculated
{
    public function setData(): Calculated;

    public function predictions(): Collection;

    public function day(): Collection;

    public function city(): Collection;
}