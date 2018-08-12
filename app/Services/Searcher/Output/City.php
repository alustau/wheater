<?php
namespace App\Services\Searcher\Output;


use App\Contracts\Services\Calculator\Resultable;
use App\Contracts\Services\Searcher\Output\Formatter;
use Carbon\Carbon;

class City implements Formatter
{
    public function format(Resultable $result)
    {
        $output = [
            'city'        => $result->city()['name'],
            'predictions' => []
        ];

        foreach ($result->predictions() as $time => $temperature) {
            $date = Carbon::createFromFormat('Y-m-d H:i:s', $time);

            $output['predictions'][] = [
                'datetime' => [
                    'human'  => $date->format('jS \\of F Y H:i'),
                    'normal' => $date->format('Y-m-d H:i'),
                ],
                'scale' => [
                    'Fahrenheit' => ($temperature * 1.8) - 459.889,
                    'Celsius'    => $temperature - 273.15
                ]
            ];
        }

        return $output;
    }
}
