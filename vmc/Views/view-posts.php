<section class="posts">

    <?php foreach($templateParams['posts'] as $post): ?>
        <div class="post">
            <div class="title"><?php echo $post->getTitle() ?></div>
            <div class="date-time">
                <span class="time"><?php echo $post->getPublicationTime() ?></span>
                <span class="date"><?php echo $post->getPublicationDate() ?></span>
            </div>
            <div class="content">
                <a href="index.php?view-post-game=<?php echo $post->getId() ?>">Visualizza Partita</a>
            </div>
            <div class="option">
                <a href="">Commenti</a>
                <a href="">Visualizza</a>
                <?php echo $post->getVote() ?>
                <button>Upvore</button>
            </div>
        </div>
    <?php endforeach ?>

</section>