<?php

namespace Calculator;

use Calculator\Tokenizing\Token;

interface Calculator
{
    /**
     * @param Token ...$tokenStream
     * @return float|int
     */
    public function calculate(Token... $tokxenStream);
}