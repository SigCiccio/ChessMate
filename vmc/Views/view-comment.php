<section class="comments">

    <form action="new-comment.php?post-id=<?php echo $_GET['view-post-comment'] ?>&user=<?php echo $_SESSION['user']->getUsername() ?>" method="post">
        <label for="new-comment">Commenta: </label>
        <input type="text" post="<?php echo $_GET['view-post-comment'] ?>" user="<?php echo $_SESSION['user']->getUsername() ?>" name="new-comment" id="new-comment">

        <input type="submit" id='submit' value="Invio">
    </form>

    <div id='comments-list'>
        <?php if(count($templateParams['comments']) == 0): ?>
            <div class="no-comment">
                Questa partita non ha ancora commenti
            </div>
        <?php else: ?>
            <?php foreach($templateParams['comments'] as $comment): ?>
                <div class="comment">
                    <div class="data">
                        <?php echo $comment->getAuthor() . " " . $comment->getPublicationDate() . " " . $comment->getPublicationTime() ?>
                    </div>
                </div>
                <div class="content">
                    <?php echo $comment->getText() ?>
                </div>
            <?php endforeach ?>
        <?php endif ?>
    </div>
    
</section>
