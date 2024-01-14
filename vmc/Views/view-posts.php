<section class="posts">
    <?php foreach($templateParams['posts'] as $post): ?>

        <div class="post">
            <div class="title"><?php echo $post->getTitle() ?></div>
            <div class="date-time">
                <span class="time"><?php echo $post->getTime() ?></span>
                <span class="date"><?php echo $post->getPublicationDate() ?></span>
            </div>
            <div class="content">
                <?php if($post->hasGame()): ?>
                    <a href="index.php?view-post-game=<?php echo $post->getId() ?>">Visualizza Partita</a>
                <?php endif ?>
            </div>
            <div class="option">
                <a href="">Commenti</a>
                <a href="">Visualizza</a>
                <?php echo $post->getVote() ?>
                <button>Upvore</button>
                <button>Downvote</button>
            </div>
        </div>
    <?php endforeach ?>

</section>