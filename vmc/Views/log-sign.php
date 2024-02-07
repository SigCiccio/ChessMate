<section class="authentication">
    <h2>Accedi</h2>

    <form action="authentication.php" method="post">
        <?php if(isset($_GET['error'])): ?>    
            <div class="error">
                <?php if( $_GET['error'] == 'mail'): ?>
                    La mail specificata non appartiene a nessun utente
                <?php elseif($_GET['error'] == 'password'): ?>
                    Password non corretta
                <?php endif; ?>
            </div>
        <?php elseif(isset($_GET['sign-error'])): ?>
            <div class="error">
                Errore: campi inseriti non validi
            </div>
        <?php endif; ?>
        <div class="login">
            <label for="mail">Email</label>    
            <input type="email" name="mail" id="mail">

            <label for="password">Password</label>
            <input type="password" name="password" id="password">
        </div>

        <div class="signin hide">
            <label for="new-mail">Email</label>
            <input type="email" name="new-mail" id="new-mail">

            <label for="new-password">Password</label>
            <input type="password" name="new-password" id="new-password">

            <label for="username">Username</label>
            <input type="text" name="username" id="username">

            <label for="name">Nome</label>
            <input type="text" name="name" id="name">

            <label for="surname">Cognome</label>
            <input type="text" name="surname" id="surname">

            <label for="birthday">Data di nascita</label>
            <input type="date" name="birthday" id="birthday">
        </div>

        <input type="submit" id="submit" value="Accedi">

        <input type="checkbox" name="sign" id="sign">
        <label for="sign">Non sei ancora registrato?</label>

    </form>

</section>