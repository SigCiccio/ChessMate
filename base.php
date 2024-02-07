<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />




    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">
    <?php
        if(isset($templateParams['style']))
            echo $templateParams['style'];
    ?>
    <link rel="stylesheet" href="css/nav.css">

    <!-- Script -->
    <script src="js/screen-size.js"></script>
    <?php
        if(isset($templateParams['script']))
            echo $templateParams['script'];
    ?>

    <!-- Rendere il titolo dinamico -->
    <title>CM - <?php echo $templateParams['title']; ?></title>
</head>
<body>
    <header class="titlebar <?php if($templateParams['title'] != 'Home') echo "hide "; else echo 'home' ?>" >
        <div>
            <i class="fa-solid fa-chess-knight" title="Cavallo che rappresenta il logo"></i>
        </div>
        <h1>ChessMate</h1>
    </header>
    <?php if(!isset($templateParams['no-nav'])): ?>
        <nav>
            <ul>
                <li><a href="index.php"><i class="fa-solid fa-house" title="Home"></i></a></li>
                <li><a href="index.php?search-user"><i class="fa-solid fa-magnifying-glass" title="Cerca"></i></a></li>
                <li><a href="index.php?my_profile"><i class="fa-solid fa-user" title="Il tuo profilo"></i></a></li>
                <li <?php if($templateParams['notification-count'] > 0) echo "class='text-red'"; ?>><a href="index.php?notifications" <?php if($templateParams['notification-count'] > 0) echo "class='text-red'"; ?>><i class="fa-solid fa-bell" title='Notifiche'></i> <?php if($templateParams['notification-count'] > 0) echo $templateParams['notification-count']; ?> </a></li> 
                <li><a href="authentication.php"><i class="fa-solid fa-right-from-bracket" title="logout"></i></a></li>
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