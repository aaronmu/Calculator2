<?php

namespace Calculator\Tokenizing;

class Addition implements Operator
{
    public function bla(Operand... $numbers)
    {
        \Assert\that(count($numbers))->min(2);

        return array_reduce(
            $numbers,
            function(Operand $carry, Operand $new) {
                return new Operand($carry->value() + $new->value());
            },
            new Operand(0)
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
        return 2;
    }
}