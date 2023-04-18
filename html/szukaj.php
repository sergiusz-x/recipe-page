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


    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Mono">
</head>
<body>
    <nav>
        <a href="index.php">
            <div class="navbar-logo">
                <img src="../images/logo.png" alt="Logo strony">
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

    
    <!-- <main>
        <div class="znalezione-przepisy-box">
            <div class="przepis-box" onclick="window.location.href = `${window.location.pathname}/../przepis.php?id=0` ">
                <div class="image-box">
                    <img src="../images/dummy.png" alt="Zdjęcie przepisu">
                </div>
                <p>Sernik krakowski</p>
            </div>
        </div>
    </main>

    <footer>
        <p>Znalezionych przepisów: 12</p>
    </footer> -->
</body>
</html>