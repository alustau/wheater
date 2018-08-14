<?php
namespace App\Services\Searcher;

use App\Contracts\Repositories\Prediction as PredictionRepositoryInterface;
use App\Contracts\Services\Calculator\Factorable as CalculatorFactorable;
use App\Contracts\Services\Searcher\Output\Factorable as OutputFactorable;
use App\Contracts\Services\Searcher\Searchable;
use App\Repositories\Prediction as PredictionRepository;
use App\Services\Calculator\Factory as CalculatorFactory;
use App\Services\Searcher\Output\Factory as OutputFactory;

class Prediction implements Searchable
{
    protected $model;

    protected $factories = [];

    protected $repositories = [];

    public function __construct(
        OutputFactorable $output = null,
        CalculatorFactorable $calculator = null,
        PredictionRepositoryInterface $prediction = null
    )
    {
        $this->factories = [
            'output'     => $output ?: new OutputFactory,
            'calculator' => $calculator ?: new CalculatorFactory
        ];

        $this->repositories = [
            'prediction' => $prediction ?: new PredictionRepository
        ];
    }

    public function city($name)
    {
        $rows = $this->repositories['prediction']->getAllByCityName($name);
        $result = $this->factories['calculator']
            ->calculator('City')
            ->calculate($rows);

        return $this->factories['output']
            ->output('City')
            ->format($result);
    }
}
