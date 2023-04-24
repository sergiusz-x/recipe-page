<?php
    require_once "connect.php";
    //
    $conn = @new mysqli($db_host, $db_user, $db_password, $db_name);
    if ($conn->connect_error) {
        echo "Błąd bazy danych!";
        exit();
    }
    //
    $query_polecane = "SELECT * FROM przepisy ORDER BY counter_odwiedzin DESC LIMIT 6";
    $query_ostatnie = "SELECT * FROM przepisy ORDER BY timestamp DESC LIMIT 6";
    //
    $query_polecane = mysqli_real_escape_string($conn, $query_polecane);
    $query_ostatnie = mysqli_real_escape_string($conn, $query_ostatnie);
    //
    $result_polecane = $conn->query($query_polecane);
    $result_ostatnie = $conn->query($query_ostatnie);
    //
    $lista_przepisow_polecane = "";
    $lista_przepisow_ostatnie = "";
    //
    if ($result_polecane->num_rows == 0 || $result_ostatnie->num_rows == 0) {
        echo '<br><br><br><h1 style="text-align: center;">Nie znaleziono przepisów!</h1>';
        exit();
    }
    //
    // POLECANE
    while ($row = $result_polecane->fetch_assoc()) {
        //
        $id_przepisu = $row["id"];
        $nazwa_przepisu = $row["nazwa"];
        $zdjecia_przepisu_list = json_decode($row['zdjecia'], true, JSON_UNESCAPED_UNICODE);
        $zdjecie_przepisu = './../images/przepisy/' . $zdjecia_przepisu_list[0];
        //
        $lista_przepisow_polecane .= 
        '<div class="przepis-box" onclick="window.location.href = `${window.location.pathname}/../przepis.php?id='.$id_przepisu.'` ">
            <div class="image-box">
                <img src="'.$zdjecie_przepisu.'" alt="Zdjęcie przepisu">
            </div>
            <p>'.$nazwa_przepisu.'</p>
        </div>';
    }
    //
    // OSTATNIO DODANE
    while ($row = $result_ostatnie->fetch_assoc()) {
        //
        $id_przepisu = $row["id"];
        $nazwa_przepisu = $row["nazwa"];
        $zdjecia_przepisu_list = json_decode($row['zdjecia'], true, JSON_UNESCAPED_UNICODE);
        $zdjecie_przepisu = './../images/przepisy/' . $zdjecia_przepisu_list[0];
        //
        $lista_przepisow_ostatnie .= 
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
    <h1>Polecane przepisy</h1>
    <div class="polecane-przepisy-box">
        '.$lista_przepisow_polecane.'
    </div>
    <br><br>
    <h1>Ostatnio dodane przepisy</h1>
    <div class="polecane-przepisy-box ostatnio-dodane-przepisy-box">
        '.$lista_przepisow_ostatnie.'
    </div>
</main>
    ';
?>