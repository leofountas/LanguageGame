<?php

namespace Model;

class Player
{

    
    public function __construct(public string $name, public int $score)
    {
        $this->name = '👤' + $name;
        $this->score = 0;
    }

    
}