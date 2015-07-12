<?php

namespace Calculator\Tokenizing;

class Power implements Operator
{
    /**
     * @param Number ...$numbers
     * @return Number
     */
    public function bla(Operand... $numbers)
    {
        return array_reduce(
            array_reverse($numbers),
            function(Operand $carry = null, Operand $new) {
                if(is_null($carry)) return $new;

                return new Operand($carry->value() ** $new->value());
            }
        );
    }

    /**
     * @return bool
     */
    public function isLeftAssociative()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isRightAssociative()
    {
        return true;
    }

    /**
     * @return int
     */
    public function precedence()
    {
        return 4;
    }

}