<?php
namespace App\Repositories;


use App\Contracts\Repositories\Prediction as Repository;
use App\Models\Prediction as Model;

class Prediction implements Repository
{
    protected $model;

    public function __construct(Model $model = null)
    {
        $this->model = $model ?: new Model;
    }

    public function getAllByCityName($name)
    {
        return $this->model->with('city', 'partner', 'scale', 'times')
            ->join('cities as c', 'predictions.city_id', '=', 'c.id')
            ->where('c.name', 'like', "%{$name}%")
            ->get();
    }
}
