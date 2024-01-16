<section class="game">

    <?php if($templateParams['post']->getAuthor() == $_SESSION['user']->getUsername()): ?>
        <div>
            <a href="delete.php?post=<?php echo $templateParams['post']->getId() ?>">Elimina partita</a>
        </div>
    <?php endif ?>

    <div id="gameboard">

    </div>

    <div id="gamecontrollers">
        <button trace='0' id="prev"><<</button>
        <button trace='1' id="next">>></button>
    </div>

    <div id="moves">
        <?php 
            require_once('GameViewer/Game.php');
            use GameViewer\Game;
            $g = new Game();
            $g->readMove($templateParams['post']->getGame()); 
        ?>
    </div>

</section>

