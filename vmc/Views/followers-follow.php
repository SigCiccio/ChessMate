<section class="comments">
    <h2><?php echo $templateParams['user']->getUsername() ?> <?php if(isset($_GET['follow'])) echo "segue:"; else echo "è seguito da:"; ?></h2>
    <div id='followers-follow-list'>
        <?php if(count($templateParams['users-list']) == 0): ?>
            Nessuno attualmente. 
        <?php else: ?>
            <?php foreach($templateParams['users-list'] as $ul): ?>
                <a href="index.php?view-profile=<?php echo $ul ?>">
                    <div>
                        <?php echo $ul ?>
                    </div>
                </a>
            <?php endforeach ?>
        <?php endif ?>
    </div>
    
</section>
