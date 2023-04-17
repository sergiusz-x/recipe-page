<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../images/favicon.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Mono">
    <title>Przepisy kulinarne</title>
    
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/main.css">

    <script src="../js/navbar.js"></script>
</head>
<body>
    <nav>
        <a href="index.php">
            <div class="navbar-logo">
                <img src="../images/logo.png" alt="Logo strony">
                <p>PRZEPISY KULINARNE</p>
            </div>
        </a>
		
        <div class="navbar-search">
            <form action="szukaj.php" method="get">
                <button class="search-icon" type="submit"><img src="../images/lupa.svg" alt="Ikona lupy"></button>
                <input class="search-input" type="text" placeholder="Wyszukaj przepis" name="query">
            </form>
        </div>
    
        <a href="konto.php" class="navbar-user">
            <img src="../images/person.svg" alt="Ikona użytkownika">
        </a>
	</nav>

    <footer>
        <p><?php include('../php/counter_index.php'); ?></p>
    </footer>

    <?php include('../php/index.php'); ?>
    
    <!-- <main>
        <h1>Polecane przepisy</h1>
        <div class="polecane-przepisy-box">
            <div class="przepis-box" onclick="window.location.href = `${window.location.pathname}/../przepis.php?id=75` ">
                <div class="image-box">
                    <img src="../images/dummy.png" alt="Zdjęcie przepisu">
                </div>
                <p>Tekst pod obrazkiem</p>
            </div>
            <div class="przepis-box" onclick="window.location.href = `${window.location.pathname}/../przepis.php?id=75` ">
                <div class="image-box">
                    <img src="../images/dummy.png" alt="Zdjęcie przepisu">
                </div>
                <p>Tekst pod obrazkiem</p>
            </div>
            <div class="przepis-box" onclick="window.location.href = `${window.location.pathname}/../przepis.php?id=75` ">
                <div class="image-box">
                    <img src="../images/dummy.png" alt="Zdjęcie przepisu">
                </div>
                <p>Tekst pod obrazkiem</p>
            </div>
        </div>
        <br><br>
        <h1>Ostatnio dodane przepisy</h1>
        <div class="polecane-przepisy-box">
            <div class="przepis-box" onclick="window.location.href = `${window.location.pathname}/../przepis.php?id=75`">
                <div class="image-box">
                    <img src="../images/dummy.png" alt="Zdjęcie przepisu">
                </div>
                <p>Tekst pod obrazkiem</p>
            </div>
            <div class="przepis-box" onclick="window.location.href = `${window.location.pathname}/../przepis.php?id=75` ">
                <div class="image-box">
                    <img src="../images/dummy.png" alt="Zdjęcie przepisu">
                </div>
                <p>Tekst pod obrazkiem</p>
            </div>
            <div class="przepis-box" onclick="window.location.href = `${window.location.pathname}/../przepis.php?id=75` ">
                <div class="image-box">
                    <img src="../images/dummy.png" alt="Zdjęcie przepisu">
                </div>
                <p>Tekst pod obrazkiem</p>
            </div>
        </div>
    </main> -->
    
</body>
</html>