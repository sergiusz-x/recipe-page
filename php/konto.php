<?php
    session_start();
    if(!isset($_SESSION['id'])) {
        header("Location: ./../html/logowanie.php");
        exit();
    }
    $id = @$_SESSION['id'];
    //
    if(!is_numeric($id)) {
        echo "Błąd #1!";
        exit();
    }
    //
    require_once "connect.php";
    $conn = @new mysqli($db_host, $db_user, $db_password, "strona");
    if ($conn->connect_error) {
        echo "Błąd bazy danych!";
        exit();
    }
    //
    $query = "SELECT * FROM `przepisy` WHERE `autor_id` = $id ORDER BY timestamp DESC";
    $query_user = "SELECT * FROM `users` WHERE `id` = $id";
    //
    $query = mysqli_real_escape_string($conn, $query);
    $query_user = mysqli_real_escape_string($conn, $query_user);
    //
    $results = $conn->query($query);
    $results_user = $conn->query($query_user);
    $lista_przepisow = "";
    //
    if (!$results_user || $results_user->num_rows == 0) {
        echo '<p style="text-align: center;">Nie znaleziono tego użytkownika!</p>';
        header("Location: ./../html/logowanie.php");
        session_unset();
        exit();
    }
    if (!$results || $results->num_rows == 0) {
        $lista_przepisow = '<p style="text-align: center;">Nie znaleziono żadnych przepisów!</p>';
    } else {
        $lista_przepisow = '<div class="searched-przepisy-box">';
        while ($row = $results->fetch_assoc()) {
            //
            $id_przepisu = $row["id"];
            $nazwa_przepisu = $row["nazwa"];
            $zdjecia_przepisu_list = json_decode($row['zdjecia'], true, JSON_UNESCAPED_UNICODE);
            $zdjecie_przepisu = './../images/przepisy/' . $zdjecia_przepisu_list[0];
            //
            $lista_przepisow .= 
            '<div class="przepis-box">
                <img src="'.$zdjecie_przepisu.'" alt="Zdjęcie przepisu" onclick="window.location.href = `${window.location.pathname}/../przepis.php?id='.$id_przepisu.'`">
                <p>'.$nazwa_przepisu.'</p>
                <button onclick="window.location.href = `${window.location.pathname}/../../html/nowyprzepis.php?id_przepisu='.$id_przepisu.'`"><img src="../images/edytuj_ikonka.svg" alt="Ikona klucza" id="button-edytuj-'.$id_przepisu.'">Edytuj</button>
                <button onclick="window.location.href = `${window.location.pathname}/../../php/usun_przepis.php?id_przepisu='.$id_przepisu.'`"><img src="../images/usun_ikonka.svg" alt="Ikona usunięcia">Usuń</button>
            </div>';
        }
        $lista_przepisow .= '</div>';
    }
    //
    $row_user = $results_user->fetch_assoc();
    $pseudonim = $row_user["pseudonim"];
    //
    $conn->close();
    //
    echo '
<main>
    <h1>Witaj '.$pseudonim.'!</h1>

    <div class="buttons-zarzadzanie">
        <div class="button">
            <a href="./../php/logout.php">Wyloguj</a>
        </div>
    </div>

    <br><br>

    <h3>Twoje przepisy</h3>
    '.$lista_przepisow.'
</main>';
?>