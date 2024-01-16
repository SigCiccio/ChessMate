<?php 
    $user = $templateParams['user'];
?>

<section class="profile">

    <section class="data">
        <div class="image">
            <?php if($user->hasImage()): ?>
                <img width="300px" src="imgs/<?php echo $user->getImage()->getUrl() ?>" alt="Immagine profilo di <?php echo $user->getUsername() ?>">
            <?php else: ?>
                <img src="imgs/default.png" alt="Immagine di default. L'utente  <?php echo $user->getUsername() ?> non ha caricato un'immagine profilo">
            <?php endif ?>
        </div>
        <div class="user-data">
                <ul>
                    <li><?php echo $user->getUsername() ?></li>
                    <li><?php echo $user->getName() . " " . $user->getSurname() ?></li>
                    <li><?php echo $user->getBio() ?></li>
                    <li><?php echo "followers " . $user->getFollowers() .  " follow " . $user->getFollow() ?></li>
                </ul>
        </div>
        <?php if(isset($_GET['my_profile'])): ?>
            <a href="index.php?modify-profile">Modifica</a>
            <a href="index.php?upload-game">Carica Partita</a>
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

