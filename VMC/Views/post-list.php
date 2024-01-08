<section class="posts">
    <?php foreach($templateParams['posts']['value'] as $post): ?>
        <div class="post">


                <div class="author">
                    <?php echo $post->getAuthor(); ?> - <?php echo $post->getPublicationDate() ?>
                </div>
                <?php if($post->getImage() != NULL): ?>
                    <div class="img">
                        <img src="imgs/<?php echo $post->getImage()->getUrl(); ?>" alt="Immagine del post <?php echo $post->getTitle(); ?>">
                    </div>
                <?php endif ?>
                <div class="content">
                    <h2><?php echo $post->getTitle(); ?></h2>
                    <p>
                        <?php echo $post->getText() ?>
                    </p>
                </div>
                <div class="bottom">
                    <?php echo $post->getVote(); ?> [up] [down]  
                    <a href="index.php?discussion_post=<?php echo $post->getId() ?>">Commenti</a>
                </div>


        </div>
    <?php endforeach ?>

</section>