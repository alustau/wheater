<?php
namespace App\Contracts\Services\Searcher\Output;


interface Factorable
{
    public function output($name): Formatter;
}
