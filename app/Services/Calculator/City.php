<?php
namespace App\Services\Calculator;


use App\Contracts\Services\Calculator\Calculable;
use App\Models\Prediction;

class City implements Calculable
{

    public function calculate($data)
    {
        $info = $data->first()->toArray();

        $predictions = collect(['predictions' => collect()]);

        foreach ($data as $prediction) {
            $predictions['predictions'] = $predictions['predictions']->merge($prediction->times->toArray());
        }

        $predictions['predictions'] = $predictions['predictions']
            ->groupBy('time')->map(function ($data) {
            return $data->avg('value');
        });

        $predictions = $predictions->merge(array_filter($info, function ($data, $key) {
            return in_array($key, ['date', 'scale', 'city']);
        }, ARRAY_FILTER_USE_BOTH));

        return $predictions;
    }
}