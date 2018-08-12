<?php
namespace App\Contracts\Services\Searcher\Output;


use App\Contracts\Services\Calculator\Result;

interface Formatter
{
    public function format(Result $result);
}
