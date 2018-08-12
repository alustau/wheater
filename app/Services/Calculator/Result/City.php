<?php
namespace App\Services\Calculator\Result;


use App\Contracts\Services\Calculator\Result;
use Illuminate\Support\Collection;

class City implements Result
{
    protected $result;

    public function __construct($result = null)
    {
        $this->result = $result ?: collect();
    }

    public function setData($result): Result
    {
        $this->result = $result;

        return $this;
    }

    public function predictions(): Collection
    {
        if (! isset($this->result['predictions'])) {
            return collect();
        }

        return $this->result['predictions'];
    }

    public function city(): Collection
    {
        if (! isset($this->result['city'])) {
            return collect();
        }

        return $this->result['city'];
    }

    public function scale(): Collection
    {
        if (! isset($this->result['scale'])) {
            return collect();
        }

        return $this->result['scale'];
    }

    public function toArray(): array
    {
        if (! $this->result) {
            return [];
        }

        return $this->result->toArray();
    }
}
