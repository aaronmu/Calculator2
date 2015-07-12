<?php

namespace Calculator\Tests\Postfix;

use Calculator\Postfix\Shuntingyard;
use Calculator\Stack;
use Calculator\Tokenizing\Addition;
use Calculator\Tokenizing\Operand;
use Calculator\Tokenizing\Subtraction;

class ShuntingyardTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function parses_a_simple_addition()
    {
        $p = new Shuntingyard();

        $this->assertEquals(
            [new Operand(1), new Operand(1), new Addition()],
            $p->parse(...[new Operand(1), new Addition(), new Operand(1)])
        );
    }

    /**
     * @test
     */
    public function parses_a_simple_subtraction()
    {
        $p = new Shuntingyard();

        $this->assertEquals(
            [new Operand(5), new Operand(2), new Subtraction()],
            $p->parse(...[new Operand(5), new Subtraction(), new Operand(2)])
        );
    }

    /**
     * @test
     * @dataProvider provideExpressions
     */
    public function parses_all_the_things($infix, $expectedPostfix)
    {
        $p = new Shuntingyard();

        $this->assertEquals(
            $expectedPostfix,
            $p->parse(...$infix)
        );
    }

    public static function provideExpressions()
    {
        return [
            'addition_and_subtraction' => [
                'infix' => [new Operand(5), new Addition(), new Operand(5), new Subtraction(), new Operand(2)],
                'postf' => [new Operand(5), new Operand(5), new Addition(), new Operand(2), new Subtraction()]
            ]
        ];
    }
}