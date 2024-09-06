<?php

namespace Model;

class Word
{

    public function __construct(private string $french_word, private string $english_answer)
    {
        $this->french_word = $french_word;
        $this->english_answer = $english_answer;
    }

    public function verify(string $answer): bool
    {

        if(strtolower($answer) === strtolower($this->english_answer)) {
            return 'nice';
        }else {
            return 'wrong';
        }
    }
}