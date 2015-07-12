<?php

namespace Calculator;

class Math
{
    private $t, $p, $c;

    public function __construct(Tokenizer $t, Parser $p, Calculator $c)
    {
        $this->t = $t;
        $this->p = $p;
        $this->c = $c;
    }

    public function expression($str)
    {
        return $this->c->calculate(...$this->p->parse(...$this->t->tokenize($str)));
    }
}