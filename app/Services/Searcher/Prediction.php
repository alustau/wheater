<?php
namespace App\Services\Searcher;

use App\Models\Prediction as PredictionModel;

class Prediction
{
    public function find($city)
    {
        $predictions = PredictionModel::with('city', 'partner', 'scale')
            ->join('cities as c', 'predictions.city_id', '=', 'c.id')
            ->where('c.name', 'like', "%{$city}%")
            ->select('predictions.*')
            ->get();

        return $predictions;
    }
}
