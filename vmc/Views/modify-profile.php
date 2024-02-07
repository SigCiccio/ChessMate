<?php 
    $user = $_SESSION['user'];
?>

<div class="modify-profile">

    <div class="data">
        <!-- <div class="image">
            <?php if($user->hasImage()): ?>
                <img width="300px" src="imgs/<?php echo $user->getImage()->getUrl() ?>" alt="Immagine profilo di <?php echo $user->getUsername() ?>">
            <?php else: ?>
                <img src="imgs/default.png" alt="Immagine di default. L'utente  <?php echo $user->getUsername() ?> non ha caricato un'immagine profilo">
            <?php endif ?>
        </div> -->

        <?php if(isset($_GET['error'])): ?>
            <div class='error'>
                Errore!
            </div>
        <?php endif ?>
        <form action="modify-profile.php" method="post" enctype="multipart/form-data">
            <div class="img-c">
                <label for="image">Cambia immagine profilo:</label>
                <input type="file" name="image" id="image" accept="image/*" onchange="loadFile(event)">
                <img id="output" src="imgs/<?php echo $_SESSION['user']->getImage()->getUrl() ?>" alt="Immagine profilo di <?php echo $_SESSION['user']->getUsername() ?>">
            </div>
            <script>
                var loadFile = function(event) {
                  var output = document.getElementById('output');
                  output.src = URL.createObjectURL(event.target.files[0]);
                  output.onload = function() {
                    URL.revokeObjectURL(output.src) 
                  }
                };
            </script>

            <label for="mail">Email: </label>
            <input type="email" name="mail" id="mail" value="<?php echo $user->getMail() ?>">

            <label for="username">Username: </label>
            <input type="text" name="username" id="username" value="<?php echo $user->getUsername() ?>">
            <label for="name">Nome: </label>
            <input type="text" name="name" id="name" value="<?php echo $user->getName() ?>">
            <label for="surname">Cognome: </label>
            <input type="text" name="surname" id="surname" value="<?php echo $user->getSurname() ?>">
            <label for="bio">Bio: </label>
            <input type="text" name="bio" id="bio" value="<?php echo $user->getBio() ?>">

            

            <div class="sub">
                <input type="submit" value="Modifica">
            </div>

        </form>
        <div class='passwd'>
            <a href="index.php?modify-password">Cambia password</a>
        </div>
    </div>
</div>

