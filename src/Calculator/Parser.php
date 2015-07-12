<?php

namespace Calculator;

use Calculator\Tokenizing\Token;

interface Parser
{
    /**
     * @param Token ...$tokenStream
     * @return Token[]
     */
    public function parse(Token... $tokenStream);
}