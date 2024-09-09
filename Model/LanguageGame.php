<?php

namespace Model;

use Model\Word;
use Model\Player;

class LanguageGame
{
    private array $words = [];
    public int $round = 1;

    public function __construct()
    {
        if (!isset($_SESSION['round'])) {
            $_SESSION['round'] = $this->round;
              
        }

        foreach (Data::words() as $frenchTranslation => $englishTranslation) 
        {
            $words = new Word($frenchTranslation, $englishTranslation);
            $this->words[] = $words;
        }

    }


    private function startNewRound() {
        if ($_SESSION['round'] >= 10) {
           
            
            header("Location:../LanguageGame/index.php?gameover=true");

            $_SESSION['round'] = 1;

        } else {
            
            $randomIndex = array_rand($this->words);
            $selectedWord = $this->words[$randomIndex];
            $_SESSION['current_word'] = $selectedWord;
        }
    }

    private function resetGame(): void
    {
        
        $_SESSION['round'] = 1;
        unset($_SESSION['current_word']);
        unset($_SESSION['correct']);
        unset($_SESSION['wrong']);
        $_SESSION['score'] = 0;
    
        // Redirect to the start page
        header("Location: index.php");
        exit();
    }


    private function checkAnswerAndContinue(): void {
        if (!isset($_POST['answer']) || !isset($_SESSION['current_word'])) {
            echo "Error: Missing answer or current word";
            return;
        }
    
        $submittedAnswer = $_POST['answer'];
        $currentWord = $_SESSION['current_word'];
    
        if ($currentWord->verify($submittedAnswer)) {
            $_SESSION['correct'] = "Correct!"; 
            
        } else {
            $_SESSION['wrong'] = "Incorrect. The correct answer was: " . $currentWord->getEnglish() . ". ";
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
