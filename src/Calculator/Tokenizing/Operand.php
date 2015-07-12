<?php

namespace Calculator\Tokenizing;

class Operand implements Token
{
    private $number;

    function __construct($number)
    {
        $this->number = $number;
    }

    public function value()
    {
        return $this->number;
    }
}