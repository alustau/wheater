<?php
namespace App\Contracts\Services\Calculator;


use Illuminate\Support\Collection;

interface Result
{
    public function setData($result): Result;

    public function predictions(): Collection;

    public function scale(): Collection;

    public function city(): Collection;

    public function toArray(): array;
}
