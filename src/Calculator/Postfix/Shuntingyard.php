<?php

namespace Calculator\Postfix;

use Calculator\Parser;
use Calculator\Stack;
use Calculator\Tokenizing\LeftParenthesis;
use Calculator\Tokenizing\Operator;
use Calculator\Tokenizing\Parenthesis;
use Calculator\Tokenizing\ParenthesisMismatch;
use Calculator\Tokenizing\RightParenthesis;
use Calculator\Tokenizing\Token;
use Calculator\Tokenizing\Operand;

/**
 * The shunting-yard algorithm is a method for parsing mathematical expressions specified in infix notation. It produces an output in Reverse Polish Notation.
 *
 * Thx Edsger Dijkstra!
 *
 * Class Shuntingyard
 * @package Calculator\Postfix
 */
class Shuntingyard implements Parser
{
    /**
     * @param Token ...$tokenStream
     * @return Token[]
     */
    public function parse(Token... $tokenStream)
    {
        $operators = new Stack();
        $output = new Stack();

        foreach ($tokenStream as $token) {
            switch(true) {
                case ($token instanceof Operand):
                    $output->push($token);
                    break;
                case ($token instanceof LeftParenthesis):
                    $operators->push($token);
                    break;
                case ($token instanceof RightParenthesis):
                    $this->handleRightParenthesis($operators, $output);
                    break;
                case ($token instanceof Operator):
                    /** @var Operator $o2 */
                    $this->handleOperator($operators, $token, $output);
                    break;
            }
        }

        while ($o = $operators->pop()) {
            if ($o instanceof Parenthesis)
                throw new ParenthesisMismatch;

            $output->push($o);
        }

        return $output->toArray();
    }

    /**
     * @param $operators
     * @param $output
     */
    private function handleRightParenthesis(Stack $operators, Stack $output)
    {
        $found = false;
        while ($p = $operators->pop()) {
            if ($p instanceof LeftParenthesis) {
                $found = true;
                break;
            } else {
                $output->push($p);
            }
        }

        if (!$found)
            throw new ParenthesisMismatch();
    }

    /**
     * @param $operators
     * @param $token
     * @param $output
     */
    private function handleOperator(Stack $operators, Operator $token, Stack $output)
    {
        while ($o2 = $operators->poke()) {
            switch (true) {
                case ($o2 instanceof Parenthesis):
                    break 2;
                case $token->isLeftAssociative() && $token->precedence() <= $o2->precedence():
                case $token->isRightAssociative() && $token->precedence() < $o2->precedence():
                    $output->push($operators->pop());
                    break;
                default:
                    break 2;
            }
        }

        $operators->push($token);
    }
}