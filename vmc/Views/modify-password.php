<?php 
    $user = $_SESSION['user'];
?>

<div class="modify-profile">

    <?php if(isset($_GET['error'])): ?>
        <div class='error'>
            <?php if(isset($_GET['old-new'])): ?>
                La Password Vecchia coincide con la Password Nuova
            <?php else: ?>
                Errore!
            <?php endif ?>
        </div>
    <?php endif ?>

    <div class="data">
        <form action="modify-password.php" method="post">
            <label for="old-password">Vecchia Password: </label>
            <input type="password" name="old-password" id="old-password">
            <label for="new-password">Nuova Password: </label>
            <input type="password" name="new-password" id="new-password">
            <label for="conf-password">Conferma Password: </label>
            <input type="password" name="conf-password" id="conf-password">

            

            <div class="sub">
                <input type="submit" value="Modifica">
            </div>

        </form>
    </div>
</div>

