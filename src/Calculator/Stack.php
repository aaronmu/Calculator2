<?php

namespace Calculator;

class Stack {
    private $items = [];

    public function pop()
    {
        return array_pop($this->items);
    }

    public function push($item)
    {
        return array_push($this->items, $item);
    }

    public function poke()
    {
        return end($this->items);
    }

    public function toArray()
    {
        return $this->items;
    }
}