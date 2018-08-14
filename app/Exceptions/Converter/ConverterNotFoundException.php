<?php
namespace App\Exceptions\Converter;


class ConverterNotFoundException extends ConverterException
{
    protected $message = 'Converter %s not found';

    public function __construct($calculator)
    {
        parent::__construct(sprintf($this->message, $calculator), 400);
    }
}
