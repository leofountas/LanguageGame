<?php

spl_autoload_register();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Game</title>

  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous" />
  <link href="View/assets/style.css" rel="stylesheet" />
</head>

<body>
  <!-- TODO: add a form for the user to play the game -->
  <header class="col-12 d-flex justify-content-center bg-danger">
    <h1 class="text-light">BAGUETTE TO ENGLISH</h1>
  </header>
  <div class="main row d-flex justify-content-center">
    <div class="col-12 d-flex justify-content-center my-5">
      <img
        class="baguette-image col-"
        src="View/assets/images/English-Baguette-removebg-preview.png"
        alt="Mr English Baguette" />
      <img
        class="speech col-"
        src="View/assets/images/Speech.png"
        alt="Mr English Baguette's speech" />
    </div>
    <div class="game-messages col-8">
      <?php
      if (isset($_SESSION['correct'])) {
        echo "<p class='correct'>" . $_SESSION['correct'] . "</p>";
        unset($_SESSION['correct']); // Unset after displaying
      } else if (isset($_SESSION['wrong'])) {
        echo "<p class='wrong'>" . $_SESSION['wrong'] . "</p>";
        unset($_SESSION['wrong']); // Unset after displaying
      } else if (isset($_SESSION['gameover'])) {
        echo "<p class='gameover'>" . $_SESSION['gameover'] . "</p>";
        unset($_SESSION['gameover']); // Unset after displaying
      }
      ?>
    </div>
    <div class="card col-8 border border-danger">
      <div class="card-header text text-center bg-danger">
        <p class="text-light fs-5">
          Translate as many words as possible and improve your English! Each
          game is 10 round, Good Luck!
        </p>
      </div>
      <div class="card-body p-0">
        <div class="col-12 d-flex flex-wrap justify-content-between mb-2 border border-danger p-2 px-3">
          <div class="d-flex flex-column flex-sm-row justify-content-between w-100">
            <h5 class="card-title mb-2 mb-sm-0 col-12 col-sm-4">Round: <span><?= $_SESSION['round'] ?></span>/10</h5>
            <h5 class="card-title mb-2 mb-sm-0 col-12 col-sm-4">Score: <span><?= $game->getScore()?></span>/10</h5>
          </div>
        </div>
      </div>
      <form class="row d-flex justify-content-center" method="post" action="">
        <label class="text-center fs-4 mb-2"><?= $_SESSION['current_word']->getFrench(); ?></label>
        <div class="col-10">
          <input
            type="text"
            class="form-control"
            placeholder="answer"
            name="answer" />

          <div class="col d-flex flex-row-reverse m-2 ">
            <button type="submit" class="btn btn-danger">submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  </div>
  <div class="modal"  id="gameoverPopup" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h5 class="modal-title text-light"></h5>
        </div>
        <div class="modal-body row text-center">
          <h2>GAME OVER!</h2>
         <p id="finalScore"></p>
        </div>
          <div class="col d-flex flex-row-reverse m-2 ">
            <button type="submit" class="btn btn-danger"><a href="../LanguageGame/index.php">Play Again</a></button>
          </div>
      </div>
    </div>
  </div>


  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>
  <!-- <script src="View/feature/modal.js"></script> -->
  <script src="View/feature/gameover.js"></script> 
</body>

</html>