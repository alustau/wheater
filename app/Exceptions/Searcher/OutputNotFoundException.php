<?php
namespace App\Exceptions\Searcher;


class OutputNotFoundException extends SearcherException
{
    protected $message = 'Output Formatter %s not found';

    public function __construct($calculator)
    {
        parent::__construct(sprintf($this->message, $calculator), 400);
    }
}
