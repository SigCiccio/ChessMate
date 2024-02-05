<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">
    <?php
        if(isset($templateParams['style']))
            echo $templateParams['style'];
    ?>

    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <?php
        if(isset($templateParams['script']))
            echo $templateParams['script'];
    ?>

    <!-- Rendere il titolo dinamico -->
    <title>CM - <?php echo $templateParams['title']; ?></title>
</head>
<body>
    <header>
        <div>
            <!-- <img src="./img/icon1.png" alt="Logo nel quale viene raffigurato una pedina degli scacchi" /> -->
        </div>
        <h1>ChessMate</h1>
    </header>
    <?php if(!isset($templateParams['no-nav'])): ?>
        <nav>
            <ul>
                <a href="index.php"><li>Home</li></a>
                <a href="index.php?search-user"><li>Cerca</li></a>
                <a href="index.php?my_profile"><li>Profilo</li></a>
                <a href="index.php?notifications"><li <?php if($templateParams['notification-count'] > 0) echo "class='bc-red'"; ?>>Notifiche <?php if($templateParams['notification-count'] > 0) echo $templateParams['notification-count']; ?> </li></a> 
                <a href="authentication.php"><li>Logout</li></a>
            </ul>
        </nav>
    <?php endif ?>
    <main>
        <?php  
            require($templateParams['content']); 
        ?>
    </main>
</body>
</html>