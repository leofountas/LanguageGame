<?php

// Require the correct variable type to be used (no auto-converting)
declare(strict_types = 1);




// Show errors so we get helpful information
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

spl_autoload_register();
session_start();

use Model\LanguageGame;
// Start the game
// Don't change anything in this file
// The LanguageGame class will be your starting point
$game = new LanguageGame();

$game->run();

require 'View\view.php';
