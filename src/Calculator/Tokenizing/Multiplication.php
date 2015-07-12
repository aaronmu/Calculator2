<?php

namespace Calculator\Tokenizing;

class Multiplication implements Operator
{
    /**
     * @param Number ...$numbers
     * @return Number
     */
    public function bla(Operand... $numbers)
    {
        return array_reduce(
            $numbers,
            function(Operand $carry = null, Operand $new) {
                if (is_null($carry)) return $new;

                return new Operand($carry->value() * $new->value());
            }
        );
    }

    /**
     * @return bool
     */
    public function isLeftAssociative()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function isRightAssociative()
    {
        return false;
    }

    /**
     * @return int
     */
    public function precedence()
    {
        return 3;
    }

}