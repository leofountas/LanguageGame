<?php

namespace Model;

class Player
{
    
    public function __construct(public string $name, public int $score)
    {
        $this->name = '👤' + $name;
    }

    public function show_name() {
        return $this->name;
    }

    public function show_score() {
        return $this->score;
    }

    public function increase_score() {
        $this->score ++;
    }
}