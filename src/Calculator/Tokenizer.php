<?php

namespace Calculator;

interface Tokenizer
{
    /**
     * @param $str
     * @return []Token
     */
    public function tokenize($str);
}