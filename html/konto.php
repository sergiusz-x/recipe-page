<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twoje konto</title>
    <link rel="icon" type="image/x-icon" href="../images/favicon.ico">
    
    <link rel="stylesheet" href="../css/konto.css">
    <link rel="stylesheet" href="../css/main.css">


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
		
        <div class="navbar-middle navbar-search">
            <a href="nowyprzepis.php" class="navbar-middle-button">
                Dodaj przepis
            </a>
        </div>
        
        <a href="konto.php" class="navbar-user">
            <img src="../images/person.svg" alt="Ikona użytkownika">
        </a>
	</nav>

    <?php include('../php/konto.php'); ?>

    <!-- <main>
        <h1>Witaj Sergiusz!</h1>

        <div class="buttons-zarzadzanie">
            <div class="button">
                <a href="./../php/logout.php">Wyloguj</a>
            </div>
        </div>

        <br><br>

        <h3>Twoje przepisy</h3>

        <div class="searched-przepisy-box">
            <div class="przepis-box">
                <img src="../images/dummy.png" alt="Zdjęcie przepisu">
                <p>Sernik krakowski</p>
                <button><img src="../images/edytuj_ikonka.svg" alt="Ikona klucza">Edytuj</button>
                <button><img src="../images/usun_ikonka.svg" alt="Ikona usunięcia">Usuń</button>
            </div>
        </div>
    </main> -->
</body>
</html>