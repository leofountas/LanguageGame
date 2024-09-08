<?php

namespace Model;

class Word
{

    public function __construct(private string $french_word, private string $english_word)
    {
        $this->french_word = $french_word;
        $this->english_word = $english_word;
    }

    public function getFrench(){
        return $this->french_word;
    }

    public function getEnglish(){
        return $this->english_word;
    }

    public function verify(string $answer): bool
    {

        if(strtolower($answer) === strtolower($this->english_word)) {
            return true;
        }else {
            return false;
        }
    }
}