<?php

namespace Calculator\Postfix;

use Calculator\Calculator;
use Calculator\Stack;
use Calculator\Tokenizing\Operand;
use Calculator\Tokenizing\Operator;
use Calculator\Tokenizing\Token;

class PostfixCalculator implements Calculator
{
    public function calculate(Token... $tokenStream)
    {
        $stack = new Stack();

        foreach ($tokenStream as $token) {
            if ($token instanceof Operand) {
                $stack->push($token);
                continue;
            }

            if ($token instanceof Operator) {
                $stack->push($token->bla($stack->pop(), $stack->pop()));
            }
        }

        return $stack->pop()->value();
    }
}