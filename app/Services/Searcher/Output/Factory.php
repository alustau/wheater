<?php
namespace App\Services\Searcher\Output;


use App\Contracts\Services\Searcher\Output\Factorable;
use App\Contracts\Services\Searcher\Output\Formatter;
use App\Exceptions\Searcher\OutputNotFoundException;

class Factory implements Factorable
{
    protected $formatters = [
        'City' => City::class
    ];

    public function output($name): Formatter
    {
        if (! isset($this->formatters[$name])) {
            throw new OutputNotFoundException($name);
        }

        return new $this->formatters[$name];
    }
}
