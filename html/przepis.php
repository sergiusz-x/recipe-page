<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sernik krakowski</title>
    <link rel="icon" type="image/x-icon" href="../images/favicon.ico">
    <link rel="stylesheet" href="../css/przepis.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Mono">
    <script src="../js/navbar.js"></script>
    <script src="../js/przepis.js"></script>
</head>
<body>
    <nav>
        <a href="index.php">
            <div class="navbar-logo">
                <img src="../images/logo.png" alt="logo">
                <p>PRZEPISY KULINARNE</p>
            </div>
        </a>
		
        <div class="navbar-search">
            <form action="szukaj.php" method="get">
                <button class="search-icon" type="submit"><img src="../images/lupa.svg" alt="Search"></button>
                <input class="search-input" type="text" placeholder="Wyszukaj przepis" name="query">
            </form>
        </div>

        <a href="konto.php" class="navbar-user">
            <img src="../images/person.svg" alt="ikona_uzytkownika">
        </a>
	</nav>


    <!-- <?php include('../php/przepis.php'); ?> -->

    <!-- <br><br><br>
    <h1 style="text-align: center;">Ten przepis nie został znaleziony!</h1> -->


    <main>
        <div class="kolumny">
            <div class="kolumna">
                <h1>Sernik krakowski</h1>

                <div class="ikonki-all-box">
                    <div class="ikonki-box">
                        <div class="image-ikonka-box">
                            <img src="../images/latwosc_0.svg" alt="trudnosc">
                        </div>
                        <p>łatwe</p>
                    </div>
                    <div class="ikonki-box">
                        <div class="image-ikonka-box">
                            <img src="../images/person.svg" alt="porcja">
                        </div>
                        <p>10 os.</p>
                    </div>
                    <div class="ikonki-box">
                        <div class="image-ikonka-box">
                            <img src="../images/zegar_ikonka.svg" alt="czas">
                        </div>
                        <p>70 min</p>
                    </div>
                </div>
        
                <div class="skladniki">
                    <ul>
                        <li>
                            <span class="fake-checkbox"></span>
                            <input type="checkbox" id="skladnik-1">
                            <label for="skladnik-1">ser twarogowy</label>
                            <span>1 kg</span>
                        </li>
                            <li>
                            <input type="checkbox" id="skladnik-2">
                            <label for="skladnik-2">mąka ziemniaczana</label>
                            <span>30 g</span>
                        </li>
                        <li>
                            <input type="checkbox" id="skladnik-3">
                            <label for="skladnik-3">mąka pszenna</label>
                            <span>15 g</span>
                        </li>
                        <li>
                            <input type="checkbox" id="skladnik-4">
                            <label for="skladnik-4">cukier</label>
                            <span>220 g</span>
                        </li>
                        <li>
                            <input type="checkbox" id="skladnik-5">
                            <label for="skladnik-5">jajka</label>
                            <span>6 sztuk</span>
                        </li>
                        <li>
                            <input type="checkbox" id="skladnik-6">
                            <label for="skladnik-6">masło</label>
                            <span>120 g</span>
                        </li>
                        <li>
                            <input type="checkbox" id="skladnik-7">
                            <label for="skladnik-7">cytryna</label>
                            <span>1 sztuka</span>
                        </li>
                        <li>
                            <input type="checkbox" id="skladnik-8">
                            <label for="skladnik-8">borówki</label>
                            <span>300 g</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="kolumna">
                <div class="zdjecie-przepisu">
                    <img src="../images/dummy.png" alt="Opis obrazka" id="gallery-zdjecie">
                    <div class="buttons-gallery">
                        <button><img src="../images/mniej_ikonka.svg" alt="poprzedni" id="button-gallery-lewo"></button>
                        <button><img src="../images/wiecej_ikonka.svg" alt="nastepny" id="button-gallery-prawo"></button>
                    </div>
                </div>
        
                <div class="przygotowanie-box">
                    <h2>Przygotowanie krok po kroku:</h2>
                    <div>
                        <h3>Krok 1</h3>
                        <p>Miękkie masło utrzyj z cukrem. Dodaj kolejno jajka i zmiksuj do połączenia</p>
                    </div>
                    <div>
                        <h3>Krok 2</h3>
                        <p>Dodaj partiami twaróg, a na koniec mąkę pszenną, mąkę ziemniaczaną i skórkę startą z cytryny. Zmiksuj krótko – tylko do połączenia się składników.</p>
                    </div>
                    <div>
                        <h3>Krok 3</h3>
                        <p>Masę przełóż do formy, wyłożonej na dnie papierem do pieczenia. Posyp z wierzchu połową borówek (150 g). Włóż do piekarnika, nagrzanego do 160 stopni, na 70 minut. Po tym czasie wyłącz piekarnik, uchyl drzwiczki i zostaw sernik do wystudzenia. Przed podaniem schłodź sernik w lodówce przez kilka godzin, a następnie udekoruj pozostałymi borówkami.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        let images = [
            "https://cdn.discordapp.com/attachments/929433539777290311/1097109004116820039/dsc_30035489481592470200000.png",
            "https://media.discordapp.net/attachments/929433539777290311/1097222648397832223/krok17600401592470200000.png",
            "https://media.discordapp.net/attachments/929433539777290311/1097222668773773453/krok24647251592470200000.png",
            "https://media.discordapp.net/attachments/929433539777290311/1097222690110193827/krok34239071592470201000.png"
        ]
    </script>

    <footer>
        <p>Odwiedziny przepisu: 21</p>
    </footer>
</body>
</html>