<?php
namespace App\Services\Calculator\Result;


use App\Contracts\Services\Calculator\Result;
use Illuminate\Support\Collection;

class City implements Result
{
    protected $result;

    public function __construct($result)
    {
        $this->result = $result;
    }

    public function setData($result): Result
    {
        $this->result = $result;

        return $this;
    }

    public function predictions(): Collection
    {
        if (! $this->result) {
            return [];
        }

        return $this->result['predictions'];
    }

    public function day(): string
    {
        return $this->result['date'];
    }

    public function city(): Collection
    {
        return $this->result['city'];
    }

    public function scale(): Collection
    {
        return $this->result['city'];
    }
}
