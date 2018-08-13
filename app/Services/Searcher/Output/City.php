<?php
namespace App\Services\Searcher\Output;


use App\Contracts\Repositories\Scale as Repository;
use App\Contracts\Services\Calculator\Resultable;
use App\Contracts\Services\Converter\Factorable;
use App\Contracts\Services\Searcher\Output\Formatter;
use App\Repositories\Scale as ScaleRepository;
use App\Services\Converter\Factory;
use Carbon\Carbon;

class City implements Formatter
{
    protected $factory;

    protected $repository;

    public function __construct(Factorable $factory = null, Repository $repository = null)
    {
        $this->factory    = $factory ?: new Factory;
        $this->repository = $repository ?: new ScaleRepository;
    }

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
                'scale' => $this->scales($temperature)
            ];
        }

        return $output;
    }

    /**
     * @param $temperature
     * @return array
     * @throws \App\Exceptions\Converter\ConverterNotFoundException
     */
    private function scales($temperature): array
    {
        $fahrenheit = $this->factory->converter('Fahrenheit');
        $celsius    = $this->factory->converter('Celsius');

        $from = $this->repository->get('Kelvin');

        return [
            'Fahrenheit' => $fahrenheit->convert($from, $temperature),
            'Celsius'    => $celsius->convert($from, $temperature)
        ];
    }
}
