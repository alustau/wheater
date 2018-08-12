<?php
namespace App\Contracts\Services\Calculator;


use Illuminate\Support\Collection;

interface Resultable
{
    public function setData($result): Resultable;

    public function predictions(): Collection;

    public function scale(): Collection;

    public function city(): Collection;

    public function toArray(): array;
}
