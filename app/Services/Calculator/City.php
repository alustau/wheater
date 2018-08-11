<?php
namespace App\Services\Calculator;


use App\Contracts\Services\Calculator\Result;
use App\Contracts\Services\Calculator\Calculable;
use App\Services\Calculator\Result\City as ResultCity;

class City implements Calculable
{
    public function calculate($data): Result
    {
        $info = $data->first()->toArray();

        $predictions = collect(['predictions' => collect()]);
        $predictions = $this->info($predictions, $info);
        $predictions = $this->averagePerTime($data, $predictions);

        return new ResultCity($predictions);
    }

    /**
     * @param $predictions
     * @param $info
     * @return mixed
     */
    private function info($predictions, $info)
    {
        return $predictions->merge(array_filter($info, function ($data, $key) {
            return in_array($key, ['date', 'scale', 'city']);
        }, ARRAY_FILTER_USE_BOTH));
    }

    /**
     * @param $predictions
     * @return mixed
     */
    private function averagePerTime($data, $predictions)
    {
        foreach ($data as $prediction) {
            $predictions['predictions'] = $predictions['predictions']->merge($prediction->times->toArray());
        }

        $predictions['predictions'] = $predictions['predictions']
            ->groupBy('time')->map(function ($data) {
                return $data->avg('value');
            });

        return $predictions;
    }
}