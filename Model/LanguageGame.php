<?php

namespace Model;

use Model\Word;
use Model\Player;

class LanguageGame
{
    private array $words = [];
    public int $round = 1;
    public int $score;

    public function __construct()
    {
        if (!isset($_SESSION['score'])) {
            $_SESSION['score'] = 0;
        }
        $this->score = $_SESSION['score'];

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
           
            
            $finalScore = $this->score;
            $this->score = 0;
            $_SESSION['score'] = $this->score;
    
            // Redirect to a page that shows the final score
            header("Location:../LanguageGame/index.php?gameover=true&score=" . $finalScore);

            $_SESSION['round'] = 1;

        } else {
            
            $randomIndex = array_rand($this->words);
            $selectedWord = $this->words[$randomIndex];
            $_SESSION['current_word'] = $selectedWord;
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
            $_SESSION['correct'] = "Correct!";
            $this->score++;
            $_SESSION['score'] = $this->score;
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

    public function getScore(){
        return $this->score;
    }
}
