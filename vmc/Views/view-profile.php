<?php 
    $user = $templateParams['user'];

    $isFollowed = false;
    foreach($_SESSION['user']->getFollowList() as $f)
    {
        if($user->getUsername() == $f)
        {
            $isFollowed = true;     
            break;
        }
    }
?>

<section class="profile">

    <section class="data">
        <div class="image">
            <?php if($user->hasImage()): ?>
                <img src="imgs/<?php echo $user->getImage()->getUrl() ?>" alt="Immagine profilo di <?php echo $user->getUsername() ?>">
            <?php else: ?>
                <img src="imgs/default.png" alt="Immagine di default. L'utente  <?php echo $user->getUsername() ?> non ha caricato un'immagine profilo">
            <?php endif ?>
        </div>
        <div class="user-data">
                <ul>
                    <li id='username'><h2><?php echo $user->getUsername() ?></h2></li>
                    <li><?php echo $user->getName() . " " . $user->getSurname() ?></li>
                    <li><?php echo $user->getBio() ?></li>
                </ul>
        </div>
        <div class="btn">
            <div class="followers-follow">
                <?php echo "<a href='index.php?followers=" . $user->getUsername() . "'><span data-user='followers'>" . $user->getFollowers() .  "</span> <span>followers</sapn></a>  <a href='index.php?follow=" . $user->getUsername() . "'><span data-user='follow'>" . $user->getFollow() . '</span> <span>follow</span></a>' ?>
            </div>
            <div class='link <?php if(!isset($_GET['my_profile']) || $_SESSION['user']->getUsername() != $user->getUsername()) echo 'center' ?>'>
                <?php if(isset($_GET['my_profile']) || $_SESSION['user']->getUsername() == $user->getUsername()): ?>
                    <a href="index.php?modify-profile"><i class="fa-solid fa-gear" title="Modifica"></i></a>
                    <a href="index.php?upload-game"><i class="fa-solid fa-square-plus" title="aggiungi partita"></i></a>
                <?php else: ?>
                    <?php if($isFollowed): ?>
                        <button id="unfollow">Non seguire più</button>
                        <button class='hide' id="follow">Segui</button>
                    <?php else: ?>
                        <button id="follow">Segui</button>
                        <button class='hide' id="unfollow">Non seguire più</button>
                    <?php endif ?>
                <?php endif ?>
            </div>
        </div>
        
        
    </section>
    
    <?php if(count($templateParams['posts']) == 0): ?>
        <section class="posts">
            <p>Nessuna partita pubblicata</p>
        </section>
    <?php else: ?>
        <?php require('vmc/Views/view-posts.php') ?>
    <?php endif ?>

</section>


<!-- <div>
    <div class="red">
        Follow
    </div>
    <?php foreach($_SESSION['user']->getFollowList() as $f): ?>
        <div><?php echo $f ?></div>
    <?php endforeach ?>

    <div class="red">
        Followers
    </div>
    <?php foreach($_SESSION['user']->getFollowersList() as $f): ?>
        <div><?php echo $f ?></div>
    <?php endforeach ?>
</div> -->

