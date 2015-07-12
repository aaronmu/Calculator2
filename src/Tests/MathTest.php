<?php

namespace Calculator\Tests;

use Calculator\Math;
use Calculator\Postfix\PostfixCalculator;
use Calculator\Postfix\Shuntingyard;
use Calculator\Tokenizing\SimpleTokenizer;

class MathTest extends \PHPUnit_Framework_TestCase
{
    public static function provideExpressions()
    {
        return [
            [
                'expression' => '1 + 8 + 1',
                'outcome' => 10,
            ],
            [
                'expression' => '8 - 10',
                'outcome' => -2,
            ],
            [
                'expression' => '7 + 20 + 3 - 15',
                'outcome' => 15,
            ],
            [
                'expression' => '7 + 5 * 2',
                'outcome' => 17,
            ],
            [
                'expression' => '7 + 5 * 2 * 5',
                'outcome' => 57,
            ],
            [
                'expression' => '7 * 2 + 10 * 2 + 7.5',
                'outcome' => 41.5,
            ],
            [
                'expression' => '10 / 2',
                'outcome' => 5,
            ],
            [
                'expression' => '10 / 2 + 10 - 7 * 5 + 10 / 5',
                'outcome' => -18,
            ],
            [
                'expression' => '10 ^ 2',
                'outcome' => 100,
            ],
            [
                'expression' => '10 ^ 2 + 8 / 2 + 10 * 2 ^ 2',
                'outcome' => 144,
            ],
            [
                'expression' => '( 5 - 3 ) * 2',
                'outcome' => 4,
            ],
            [
                'expression' => '10 ^ 2 + 8 / ( 2 + 2 ) * 2 ^ ( 2 * 2 )',
                'outcome' => 132,
            ],
        ];
    }

    /**
     * @test
     * @dataProvider provideExpressions
     */
    public function expressions($expr, $out)
    {
        $m = new Math(
            new SimpleTokenizer(),
            new Shuntingyard(),
            new PostfixCalculator()
        );

        $this->assertEquals($out, $m->expression($expr));
    }

    /**
     * @test
     * @dataProvider provideParenthesisMismatch
     */
    public function parenthesis_mismatch($expr)
    {
        $m = new Math(
            new SimpleTokenizer(),
            new Shuntingyard(),
            new PostfixCalculator()
        );

        $this->setExpectedException('Calculator\Tokenizing\ParenthesisMismatch');

        $m->expression($expr);
    }

    public static function provideParenthesisMismatch()
    {
        return [
            ['( 1 + 2'],
            ['( 1 + 2 ) )'],
            ['( ( 1 + 2 ) + ( 7 - 3 ) ) + ( ( ( 3 + 9 ) ) '],
        ];
    }
}