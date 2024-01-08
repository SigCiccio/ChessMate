<section class="discussions">

    <?php foreach($templateParams['discussions']['model'] as $discussion): ?>

        <div class="discussion">
            <?php echo $discussion->getAuthor(); ?>: <?php echo $discussion->getText(); ?>

            <?php if($discussion->hasSubdiscussion()): ?>
                <div class="subdiscussion">
                    <?php foreach($discussion->getSubdiscussions() as $sub): ?>
                        <?php echo $sub->getAuthor(); ?>: <?php echo $sub->getText(); ?>
                    <?php endforeach ?>
                </div>
            <?php endif ?>
        </div>
    <?php endforeach ?>
</section>