<?php

namespace Calculator\Tests\Postfix;

use Calculator\Postfix\PostfixCalculator;
use Calculator\Tokenizing\Addition;
use Calculator\Tokenizing\Operand;
use Calculator\Tokenizing\Subtraction;

class PostfixCalculatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider provideAdditions
     */
    public function additions($result, array $addition)
    {
        $c = new PostfixCalculator();
        $this->assertEquals($result, $c->calculate(...$addition));
    }

    /**
     * @test
     */
    public function subtractions()
    {
        $c = new PostfixCalculator();
        $this->assertEquals(5, $c->calculate(...[new Operand(7), new Operand(2), new Subtraction()]));
    }

    public static function provideAdditions()
    {
        return [
            'simple addition' => [
                'result' => 3,
                'addition' => [new Operand(1), new Operand(2), new Addition()],
            ],
            'complexer addition' => [
                'result' => 11,
                'addition' => [new Operand(1.5), new Operand(2.5), new Addition(), new Operand(7), new Addition()],
            ],
        ];
    }

    /**
     * @test
     */
    public function additions_and_subtractions()
    {
        $c = new PostfixCalculator();
        $this->assertEquals(4, $c->calculate(...[new Operand(7), new Operand(2), new Addition(), new Operand(5), new Subtraction()]));
    }
}