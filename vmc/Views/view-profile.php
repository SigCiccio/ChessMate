<?php 
    $user = $templateParams['user'];
?>

<section class="profile">

    <section class="data">
        <div class="image">
            <?php if($user->hasImage()): ?>
                <img width="300px" src="imgs/<?php echo $user->getImage()->getUrl() ?>" alt="Immagine profilo di <?php echo $user->getUsername() ?>">
            <?php else: ?>
                <img width="300px" src="imgs/default.png" alt="Immagine di default. L'utente  <?php echo $user->getUsername() ?> non ha caricato un'immagine profilo">
            <?php endif ?>
        </div>
        <div class="user-data">
                <ul>
                    <li user-attr='username'><?php echo $user->getUsername() ?></li>
                    <li><?php echo $user->getName() . " " . $user->getSurname() ?></li>
                    <li><?php echo $user->getBio() ?></li>
                    <li><?php echo "<a href='index.php?followers=" . $user->getUsername() . "'>followers <span user-attr='followers'>" . $user->getFollowers() .  "</span></a>  <a href='index.php?follow=" . $user->getUsername() . "'>follow <span user-attr='follow'>" . $user->getFollow() . '</span></a>' ?></li>
                </ul>
                <a href="index.php?follow=<?php echo $user->getUsername() ?>"></a>
        </div>
        <?php if(isset($_GET['my_profile'])): ?>
            <a href="index.php?modify-profile">Modifica</a>
            <a href="index.php?upload-game">Carica Partita</a>
        <?php else: ?>
            <?php if(in_array($user->getUsername(),$_SESSION['user']->getFollowList())): ?>
                <button id="unfollow">Non seguire più</button>
                <button class='hide' id="follow">Segui</button>
            <?php else: ?>
                <button id="follow">Segui</button>
                <button class='hide' id="unfollow">Non seguire più</button>
            <?php endif ?>
        <?php endif ?>
        </section>
    
    <?php if(count($templateParams['posts']) == 0): ?>
        <section class="posts">
            <p>Nessuna partita pubblicata</p>
        </section>
    <?php else: ?>
        <?php require('vmc/Views/view-posts.php') ?>
    <?php endif ?>

</section>

