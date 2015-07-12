<?php

namespace Calculator\Tests\Tokenizing;

use Calculator\Tokenizing\Addition;
use Calculator\Tokenizing\Operand;
use Calculator\Tokenizing\SimpleTokenizer;
use Calculator\Tokenizing\Subtraction;

class TokenizingTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider provideValidString
     */
    public function valid_string($inputString, $expectedOutput)
    {
        $t = new SimpleTokenizer();
        $this->assertEquals($expectedOutput, $t->tokenize($inputString));
    }

    public static function provideValidString()
    {
        return [
            'simple addition' => [
                'input' => '1 + 1',
                'outpt' => [new Operand(1), new Addition(), new Operand(1)]
            ],
            'simple subtraction' => [
                'input' => '1 - 1',
                'outpt' => [new Operand(1), new Subtraction(), new Operand(1)]
            ],
            'complex addition' => [
                'input' => '9.1 + 2.9 + 7',
                'outpt' => [new Operand(9.1), new Addition(), new Operand(2.9), new Addition(), new Operand(7)]
            ],
            'ignores redundant spaces' => [
                'input' => '1    +        1          ',
                'outpt' => [new Operand(1), new Addition(), new Operand(1)]
            ],
        ];
    }

    /**
     * @test
     * @dataProvider provideInvalidString
     */
    public function invalid_string($invalidInput)
    {
        $this->setExpectedException('Calculator\Tokenizing\InvalidInput');

        $t = new SimpleTokenizer();
        $t->tokenize($invalidInput);
    }

    public static function provideInvalidString()
    {
        return [
            'Spaces are required' => ['input' => '1+1'],
        ];
    }
}