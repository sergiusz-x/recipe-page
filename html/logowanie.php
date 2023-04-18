<?php
    session_start();
    if(isset($_SESSION['id'])) {
        header("Location: konto.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <link rel="icon" type="image/x-icon" href="../images/favicon.ico">
    
    <link rel="stylesheet" href="../css/logowanie.css">
    <link rel="stylesheet" href="../css/main.css">

    <script src="../js/login.js"></script> 

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Mono">
</head>
<body>
    <nav class="navbar-center">
        <a href="index.php">
            <div class="navbar-logo">
                <img src="../images/logo.png" alt="Logo strony">
                <p>PRZEPISY KULINARNE</p>
            </div>
        </a>
	</nav>

    <main>
        <div class="login-register-box">
            <div class="login-register-buttons">
              <button id="login-button" class="active">Logowanie</button>
              <button id="register-button">Rejestracja</button>
            </div>
          
            <div class="login-form">
                <input required type="email" name="email" placeholder="E-mail" value="admin@admin.pl">
                <input required type="password" name="password" placeholder="Hasło" value="Adminadmin123!">
            </div>
          
            <div class="register-form" style="display:none;">
                <input required type="email" name="email" placeholder="E-mail" value="admin@admin.pl">
                <input required type="text" name="pseudonim" placeholder="Pseudonim" value="Sergiusz">
                <input required type="password" name="password" placeholder="Hasło" value="Adminadmin123!">
            </div>
          
            <button id="submit-button">Zaloguj</button>
          </div>
    </main>
</body>
</html>