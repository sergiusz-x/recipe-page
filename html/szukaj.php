<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Szukaj</title>
    <link rel="icon" type="image/x-icon" href="../images/favicon.ico">
    
    <link rel="stylesheet" href="../css/szukaj.css">
    <link rel="stylesheet" href="../css/main.css">

    <script src="../js/navbar.js"></script>
    <script src="../js/canvas_logo.js"></script>


    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Mono">
</head>
<body>
    <nav>
        <a href="index.php">
            <div class="navbar-logo">
                <noscript><img src="../images/logo.png" alt="Logo strony"></noscript>
                <canvas id="canvas-logo" width="110" height="110"></canvas>
                <p>PRZEPISY KULINARNE</p>
            </div>
        </a>
		
        <div class="navbar-search" id="div-navbar-search">
            <form action="szukaj.php" method="get">
                <button class="search-icon" type="submit"><img src="../images/lupa.svg" alt="Ikona lupy"></button>
                <input class="search-input" type="text" placeholder="Wyszukaj przepis" name="query">
            </form>
        </div>

        <a href="konto.php" class="navbar-user">
            <img src="../images/person.svg" alt="Ikona użytkownika">
        </a>
	</nav>
    
    <?php include('../php/szukaj.php'); ?>
</body>
</html>