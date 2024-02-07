<section class="game">

    <h2><?php echo $templateParams['post']->getTitle() ?></h2>

    <?php if($templateParams['post']->getAuthor() == $_SESSION['user']->getUsername()): ?>
        <a href="delete.php?post=<?php echo $templateParams['post']->getId() ?>"><i class="fa-solid fa-trash" title="Elimina partita"></i></a>
    <?php endif ?>

    <div class="conteiner">
        <div id="gameboard">

        </div>
    </div>

    <div id="gamecontrollers">
        <button data-trace='0' id="prev"><i class="fa-solid fa-arrow-left" title="Indietro"></i></button>
        <button data-trace='1' id="next"><i class="fa-solid fa-arrow-right" title="Avanti"></i></button>
    </div>

    <div id="moves">
        <ul>
        <?php 
            require_once('GameViewer/Game.php');
            use GameViewer\Game;
            $g = new Game();
            $g->readMove($templateParams['post']->getGame()); 
        ?>
        </ul>
    </div>

</section>

