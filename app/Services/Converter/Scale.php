<?php
namespace App\Services\Converter;

use App\Contracts\Services\Converter\Scalable;

class Scale implements Scalable
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public static function set($data): Scalable
    {
        return new static($data);
    }

    public function name()
    {
        return isset($this->data['name']) ? $this->data['name'] : null;
    }

    public function formula()
    {
        return isset($this->data['formula']) ? $this->data['formula'] : null;
    }
}
