<section class="profile">
    <div class="head">
        <div>
            <!-- <img width="100px" src="imgs/<?php # echo $templateParams['user']->getImage()->getUrl(); ?>" alt="Immagine profilo di <?php echo $templateParams['user']->getUsername();?>" > -->
        </div>
        <ul>
            <li><?php echo $templateParams['user']->getUsername() ?></li>
            <li><?php echo $templateParams['user']->getNationality() ?></li>
            <li><?php echo $templateParams['user']->getBio() ?></li>
            <li><?php echo $templateParams['user']->getElo() ?></li>
            <li>Followers <?php echo $templateParams['user']->getFollowers() ?></li>
            <li>Follow <?php echo $templateParams['user']->getFollow() ?></li>
            <?php if(isset($_GET['my_profile'])): ?>
                <a href="index.php?modify-profile"><li>Modifica</li></a>
            <?php endif ?>
        </ul>
    </div>
</section>