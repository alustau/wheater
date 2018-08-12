<?php
namespace App\Contracts\Services\Searcher\Output;


use App\Contracts\Services\Calculator\Resultable;

interface Formatter
{
    public function format(Resultable $result);
}
