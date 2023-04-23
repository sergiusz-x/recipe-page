<?php
    require_once "connect.php";
    //
    $query = @urldecode(@$_GET['query']);
    if(!$query || $query == "" || str_replace(" ", "", $query) == "") {
        echo '
        <main>
            <p style="text-align: center; margin-top: 100px; font-size: 20px;">Wpisz przepis który chcesz wyszukać!</p>
            <div class="navbar-search navbar-search-middle">
                <form action="szukaj.php" method="get">
                    <button class="search-icon" type="submit"><img src="../images/lupa.svg" alt="Ikona lupy"></button>
                    <input class="search-input" type="text" placeholder="Wyszukaj przepis" name="query">
                </form>
            </div>
        </main>
        <script>
            const div_navbar_search =document.getElementById("div-navbar-search")
            if(div_navbar_search) div_navbar_search.style = "display: none;"
        </script>';
        exit();
    }
    //
    $conn = @new mysqli($db_host, $db_user, $db_password, "strona");
    if ($conn->connect_error) {
        echo "Błąd bazy danych!";
        exit();
    }
    //
    $query = strtolower(str_replace(' ', '', $query));
    $query = mysqli_real_escape_string($conn, $query);
    $zapytanie_sql_tresc = "SELECT * FROM `przepisy` WHERE LOWER(REPLACE(nazwa, ' ', '')) LIKE '%$query%'";
    //
    $keywordsqlinjection = array('insert', 'truncate', 'update', 'delete', 'drop', 'create', ';', '--');
    $lowercase_query = strtolower($zapytanie_sql_tresc);
    foreach($keywordsqlinjection as $word) {
        if(strpos($lowercase_query, $word) !== false) {
            echo "Błąd wyszukiwania przepisów #1";
            exit();
        }
    }
    //
    $results = $conn->query($zapytanie_sql_tresc);
    $lista_przepisow = "";
    $liczba_przepisow = @$results->num_rows;
    //
    if (!$results || $liczba_przepisow == 0) {
        echo '<br><br><br><h1 style="text-align: center;">Nie znaleziono żadnych przepisów dla: '.$tresc_zapytania.'</h1>';
        exit();
    }
    //
    while ($row = $results->fetch_assoc()) {
        //
        $id_przepisu = $row["id"];
        $nazwa_przepisu = $row["nazwa"];
        $zdjecia_przepisu_list = json_decode($row['zdjecia'], true, JSON_UNESCAPED_UNICODE);
        $zdjecie_przepisu = './../images/przepisy/' . $zdjecia_przepisu_list[0];
        //
        $lista_przepisow .= 
        '<div class="przepis-box" onclick="window.location.href = `${window.location.pathname}/../przepis.php?id='.$id_przepisu.'` ">
            <div class="image-box">
                <img src="'.$zdjecie_przepisu.'" alt="Zdjęcie przepisu">
            </div>
            <p>'.$nazwa_przepisu.'</p>
        </div>';
    }
    //
    $conn->close();
    //
    echo '
<main>
    <div class="znalezione-przepisy-box">
        '.$lista_przepisow.'
    </div>
</main>

<footer>
    <p>Znalezionych przepisów: '.$liczba_przepisow.'</p>
</footer>
    ';
?>