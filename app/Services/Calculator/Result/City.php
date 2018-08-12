<?php
namespace App\Services\Calculator\Result;


use App\Contracts\Services\Calculator\Resultable;
use Illuminate\Support\Collection;

class City implements Resultable
{
    protected $result;

    public function __construct($result = null)
    {
        $this->result = $result ?: collect();
    }

    public function setData($result): Resultable
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
