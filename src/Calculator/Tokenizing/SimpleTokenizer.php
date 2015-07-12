<?php

namespace Calculator\Tokenizing;

use Calculator\Tokenizer;

class SimpleTokenizer implements Tokenizer
{
    /**
     * @param $str
     * @return Token[]
     */
    public function tokenize($str)
    {
        // array_values is used to prevent arrays from looking like [5 => Token(), 9 => Token()], it's not important.
        return array_values(array_map(
            function($part) {
                switch(true) {
                    case is_numeric($part):
                        return new Operand($part);
                    case $part === '+':
                        return new Addition();
                    case $part === '-':
                        return new Subtraction();
                    case $part === '*':
                        return new Multiplication();
                    case $part === '/':
                        return new Division();
                    case $part === '^':
                        return new Power();
                    case $part === '(':
                        return new LeftParenthesis();
                    case $part === ')':
                        return new RightParenthesis();
                    default:
                        throw new InvalidInput('Could not convert ' . $part . ' to token');
                }
            },
            array_filter(
                explode(' ', $str),
                function($part) { return $part !== ''; }
            )
        ));
    }
}