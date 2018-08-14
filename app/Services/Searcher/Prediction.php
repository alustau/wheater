<?php
namespace App\Services\Searcher;

use App\Contracts\Services\Calculator\Factorable as CalculatorFactorable;
use App\Contracts\Services\Searcher\Output\Factorable as OutputFactorable;
use App\Contracts\Services\Searcher\Searchable;
use App\Services\Calculator\Factory as CalculatorFactory;
use App\Services\Searcher\Output\Factory as OutputFactory;

class Prediction implements Searchable
{
    protected $model;

    protected $factories = [];

    protected $repositories = [];

    public function __construct(
        OutputFactorable $output = null,
        CalculatorFactorable $calculator = null
    )
    {
        $this->factories = [
            'output'     => $output ?: new OutputFactory,
            'calculator' => $calculator ?: new CalculatorFactory
        ];

        //model configurations
    }

    public function city($name)
    {

    }
}
