<section class="comments">

    <?php if(count($templateParams['comments']) == 0): ?>
        <div class="no-comment">
            Questa partita non ha ancora commenti
        </div>
    <?php else: ?>
        <?php foreach($templateParams['comments'] as $comment): ?>
            <div class="comment">
                <div class="data"><?php echo $comment->getAuthor() . " " . $comment->getPublicationDate() . " " . $comment->getPublicationTime() ?></div>
            </div>
            <div class="content">
                <?php echo $comment->getText() ?>
            </div>
        <?php endforeach ?>
    <?php endif ?>
    
</section>