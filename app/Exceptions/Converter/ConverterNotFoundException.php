<?php
namespace App\Exceptions\Converter;


class ConverterNotFoundException extends ConverterException
{
    protected $message = 'Converter %s not found';

    public function __construct($converter)
    {
        parent::__construct(sprintf($this->message, $converter), 400);
    }
}
