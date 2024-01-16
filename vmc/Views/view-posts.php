<section class="posts">
    <?php 
        require_once('GameViewer/Game.php');
        use GameViewer\Game;
        $g = new Game();
    ?>

    <?php foreach($templateParams['posts'] as $post): ?>
        <div class="post">
            <div class="title"><?php echo $post->getTitle() ?></div>
            <div class="date-time">
                <span class="time"><?php echo $post->getPublicationTime() ?></span>
                <span class="date"><?php echo $post->getPublicationDate() ?></span>
            </div>
            <div class="gameboard" position="<?php echo $g->getFinalPosition($post->getGame()) ?>">
                
            </div>
            
            <?php if($post->getAuthor() == $_SESSION['user']->getUsername()): ?>
                <div>
                    <a href="delete.php?post=<?php echo $post->getId() ?>">Elimina partita</a>
                </div>
            <?php endif ?>

            <div class="option">
                <a href="index.php?view-post-comment=<?php echo $post->getId() ?>">Commenti</a>
                <a href="index.php?view-post-game=<?php echo $post->getId() ?>">Visualizza</a>
                <?php echo $post->getVote() ?>
                <button>Upvote</button>
            </div>
        </div>
    <?php endforeach ?>

</section>