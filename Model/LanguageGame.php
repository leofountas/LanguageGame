<?php

namespace Model;

use Model\Word;

class LanguageGame
{
    private array $words = [];
    public int $round = 1;

    public function __construct()
    {
       
        foreach (Data::words() as $frenchTranslation => $englishTranslation) 
        {
            $words = new Word($frenchTranslation, $englishTranslation);
            $this->words[] = $words;
        }

    }

    private function startNewRound() {
        
        if ($_SESSION['round'] <= 10) {
        $randomIndex = array_rand($this->words);
        $selectedWord = $this->words[$randomIndex];
        $_SESSION['current_word'] = $selectedWord;

        }else {
            echo "Game Over!";
            $_SESSION['round']=1;
        }
        
    }

    private function checkAnswerAndContinue(): void {
        if (!isset($_POST['answer']) || !isset($_SESSION['current_word'])) {
            echo "Error: Missing answer or current word";
            return;
        }
    
        $submittedAnswer = $_POST['answer'];
        $currentWord = $_SESSION['current_word'];
    
        if ($currentWord->verify($submittedAnswer)) {
            echo "Correct! ";
            
        } else {
            echo "Incorrect. The correct answer was: " . $currentWord->getEnglish() . ". ";
        }
        
        // Start a new round immediately after checking the answer
        $_SESSION['round']++;
        $this->startNewRound();
    }

    public function run(): void
    {
      
        if (!isset($_POST['answer'])) {
            $this->startNewRound();
        } else {
                $this->checkAnswerAndContinue();
               
            }
    }
}
