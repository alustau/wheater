<?php
namespace App\Exceptions\Calculator;


class CalculatorNotFoundException extends CalculatorException
{
    protected $message = 'Calculator %s not found';

    public function __construct($calculator)
    {
        parent::__construct(sprintf($this->message, $calculator), 400);
    }
}