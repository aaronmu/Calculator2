<?php

namespace Calculator\Tokenizing;

interface Operator extends Token
{
    /**
     * @param Number ...$numbers
     * @return Number
     */
    public function bla(Operand... $numbers);

    /**
     * @return bool
     */
    public function isLeftAssociative();

    /**
     * @return bool
     */
    public function isRightAssociative();

    /**
     * @return int
     */
    public function precedence();
}