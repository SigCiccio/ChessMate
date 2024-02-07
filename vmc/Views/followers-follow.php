<section class="comments">
    <h2><?php echo $templateParams['user']->getUsername() ?> <?php if(isset($_GET['follow'])) echo "segue:"; else echo "è seguito da:"; ?></h2>
    <div id='followers-follow-list'>
        <?php if(count($templateParams['users-list']) == 0): ?>
            Nessuno attualmente. 
        <?php else: ?>
            <?php foreach($templateParams['users-list'] as $us): 
                $ul = $uc->selectUserFromUsername($us);
                ?>
                <a href="index.php?view-profile=<?php echo $ul->getUsername() ?>">
                    <div class='user'>
                        <div class='img'>
                            <img src="imgs/<?php echo $ul->getImage()->getUrl() ?>" alt="Immagine profilo di <?php echo $ul->getUsername() ?>">
                        </div>
                        <div class="username"><?php echo $ul->getUsername() ?></div>
                    </div>
                </a>
            <?php endforeach ?>
        <?php endif ?>
    </div>
    
</section>
