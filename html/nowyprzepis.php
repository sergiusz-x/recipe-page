<?php
    session_start();
    if(!isset($_SESSION['id'])) {
        header("Location: konto.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nowy przepis</title>
    <link rel="icon" type="image/x-icon" href="../images/favicon.ico">
    
    <link rel="stylesheet" href="../css/nowyprzepis.css">
    <link rel="stylesheet" href="../css/main.css">

    <script src="../js/nowyprzepis.js"></script>

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
            <button class="navbar-middle-button" id="dodaj-przepis-button">Zapisz przepis</button>
        </div>

        <a href="konto.php" class="navbar-user">
            <img src="../images/person.svg" alt="Ikona użytkownika">
        </a>
	</nav>

    <main>
        <div class="dane-box">
            <p>Nazwa przepisu</p>
            <input type="text" id="nazwa-przepisu" name="nazwa-przepisu">

            <br><br>

            <div class="trudnosc-porcja-realizacja-box">
                <div>
                    Trudność
                    <div class="trudnosc-box">
                        <label class="radio-box" for="trudnosc-latwe">
                            <input type="radio" id="trudnosc-latwe" name="trudnosc" value="latwe" checked>
                            <br>
                            łatwe
                            <span class="fake-radio"></span>
                        </label>
                        <label class="radio-box" for="trudnosc-srednie">
                            <input type="radio" id="trudnosc-srednie" name="trudnosc" value="srednie">
                            <br>
                            średnie
                            <span class="fake-radio"></span>
                        </label>
                        <label class="radio-box" for="trudnosc-trudne">
                            <input type="radio" id="trudnosc-trudne" name="trudnosc" value="trudne">
                            <br>
                            trudne
                            <span class="fake-radio"></span>
                        </label>
                    </div>
                </div>

                <div>
                    Porcja na
                    <div class="porcjana-box">
                        <p id="porcja-na-wartosc">2 osoby</p>
                        <div class="box-buttons-zwiekszanie-zmniejszanie">
                            <button type="button" class="button-zwiekszenie" id="porcja-button-zwieksz"><img src="../images/wiecej_ikonka.svg" alt="Ikona strzałki w górę"></button>
                            <button type="button" class="button-zmniejszenie" id="porcja-button-zmniejsz"><img src="../images/mniej_ikonka.svg" alt="Ikona strzałki w dół"></button>
                        </div>
                    </div>
                </div>

                <div>
                    Czas realizacji
                    <div class="porcjana-box">
                        <p id="czas-realizacji-wartosc">30 min</p>
                        <div class="box-buttons-zwiekszanie-zmniejszanie">
                            <button type="button" class="button-zwiekszenie" id="czasrealizacji-button-zwieksz"><img src="../images/wiecej_ikonka.svg" alt="Ikona strzałki w górę"></button>
                            <button type="button" class="button-zmniejszenie" id="czasrealizacji-button-zmniejsz"><img src="../images/mniej_ikonka.svg" alt="Ikona strzałki w dół"></button>
                        </div>
                    </div>
                </div>
            </div>

            <br><br>

            <p>Składniki</p>
            <div class="skladniki-box">
                <div class="skladnik" id="skladniki-box-oryginal">
                    <input type="text" class="skladnik-nazwa-input">
                    <input type="text" class="skladnik-wielkosc-input">
                    <select name="wybor" class="skladnik-typ-wielkosci-select">
                        <option value="g">g</option>
                        <option value="kg">kg</option>
                        <option value="ml">ml</option>
                        <option value="L">L</option>
                        <option value="szt.">szt.</option>
                    </select>
                </div>
            </div>
            <div class="buttons-wiecej-mniej-elementow">
                <button class="button-wiecej-elementow" id="skladniki-button-dodaj"><img src="../images/plus_ikonka.svg" alt="Ikona plusa"></button>
                <button class="button-mniej-elementow"  id="skladniki-button-usun" disabled><img src="../images/minus_ikonka.svg" alt="Ikona minusa"></button>
            </div>

            <br><br>

            <p>Przygotowanie</p>
            <div class="przygotowanie-box">
                <div class="krok-przygotowania" id="przygotowanie-box-oryginal">
                    <textarea class="textarea-krok-przygotowania"></textarea>
                </div>
            </div>
            <div class="buttons-wiecej-mniej-elementow">
                <button class="button-wiecej-elementow" id="przygotowanie-button-dodaj"><img src="../images/plus_ikonka.svg" alt="Ikona plusa"></button>
                <button class="button-mniej-elementow" id="przygotowanie-button-usun" disabled><img src="../images/minus_ikonka.svg" alt="Ikona minusa"></button>
            </div>


            <br><br>

            <p>Zdjęcia</p>
            <div class="zdjecia-box">
                <button class="button-dodaj-zdjecie" onclick="wybierzZdjecia()"><img src="../images/plus_ikonka.svg" alt="Ikona plusa"></button>
            </div>

            <div class="podglad-zdjecia">
                <!-- <img src="../images/dummy.png" alt="Podgląd dodanego zdjęcia" class="src-dodane-zdjecie">
                <img src="../images/dummy.png" alt="Podgląd dodanego zdjęcia" class="src-dodane-zdjecie">
                <img src="../images/dummy.png" alt="Podgląd dodanego zdjęcia" class="src-dodane-zdjecie"> -->
            </div>
        </div>
    </main>
</body>
</html>