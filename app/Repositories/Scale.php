<?php
namespace App\Repositories;


use App\Contracts\Repositories\Scale as Repository;
use App\Contracts\Services\Converter\Scalable;
use App\Models\Scale as Model;
use App\Services\Converter\Scale as ScaleConverter;

class Scale implements Repository
{
    protected $model;

    public function __construct(Model $model = null)
    {
        $this->model = $model ?: new Model;
    }

    public function get($name): Scalable
    {
        $scale = $this->model->where('name', $name)->first();

        return ScaleConverter::set(
            isset($scale->id) ? $scale->toArray() : []
        );
    }
}
