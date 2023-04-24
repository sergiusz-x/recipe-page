<?php
    require_once "connect.php";
    //
    $id = @$_GET['id'];
    if (!is_numeric($id)) {
        echo '<br><br><br><h1 style="text-align: center;">Ten przepis nie został znaleziony!</h1>';
        exit();
    }
    //
    $conn = @new mysqli($db_host, $db_user, $db_password, $db_name);
    if ($conn->connect_error) {
        echo "Błąd bazy danych!";
        exit();
    }
    //
    $id = mysqli_real_escape_string($conn, $id);
    //
    $query = "SELECT * FROM przepisy WHERE id=$id";
    $query = mysqli_real_escape_string($conn, $query);
    $result = $conn->query($query);
    //
    if ($result->num_rows == 0) {
        echo '<br><br><br><h1 style="text-align: center;">Ten przepis nie został znaleziony!</h1>';
        exit();
    }
    //
    $row = $result->fetch_assoc();
    //
    $trudnosc = 'łatwe';
    switch ($row['trudnosc']) {
        case 1:
            $trudnosc = 'średnie';
            break;
        case 2:
            $trudnosc = 'trudne';
            break;
    }
    //
    $porcja = $row['porcja'] . ' os.';
    //
    $czas = $row['czas_realizacji'] . ' min';
    //
    $skladniki = '';
    $skladniki_list = json_decode($row['skladniki'], true, JSON_UNESCAPED_UNICODE);
    $index = 1;
    foreach ($skladniki_list as $skladnik) {
        $skladniki .= 
        '<li>
            <input type="checkbox" id="skladnik-'.$index.'">
            <label for="skladnik-'.$index.'">'.$skladnik['nazwa'].'</label>
            <span>'.$skladnik['wielkosc'].' '.$skladnik['typ_wielkosci'].'</span>
        </li>';
        $index++;
    }
    //
    //
    $zdjecia_list = json_decode($row['zdjecia'], true, JSON_UNESCAPED_UNICODE);
    $zdjecie = './../images/przepisy/' . $zdjecia_list[0];
    $zdjecia_list_txt = json_decode($row['zdjecia'], true, JSON_UNESCAPED_UNICODE);
    foreach($zdjecia_list_txt as &$zdjecie) {
        $zdjecie = './../images/przepisy/' . $zdjecie;
    }
    $zdjecia_list_txt = json_encode($zdjecia_list_txt);
    //
    //
    $kroki = '';
    $kroki_list = json_decode($row['przygotowanie'], true, JSON_UNESCAPED_UNICODE);
    $index = 1;
    foreach ($kroki_list as $krok) {
        $kroki .=
        '<div>
            <h3>Krok '.$index.'</h3>
            <p>'.$krok.'</p>
        </div>';
        $index++;
    }
    //
    //
    $odwiedziny = $row['counter_odwiedzin'];
    if (!isset($_COOKIE["odwiedzony-przepis-$id"])) {
        setcookie("odwiedzony-przepis-$id", 1, time()+60*1);
        $odwiedziny++;
        $sql = "UPDATE przepisy SET counter_odwiedzin = $odwiedziny WHERE id = $id";
        $sql = mysqli_real_escape_string($conn, $sql);
        $conn->query($sql);
    }
    //
    $conn->close();
    //
    echo '
<main>
    <div class="kolumny">
        <div class="kolumna">
            <h1>'.$row['nazwa'].'</h1>

            <div class="ikonki-all-box">
                <div class="ikonki-box">
                    <div class="image-ikonka-box">
                        <img src="../images/latwosc_'.$row['trudnosc'].'.svg" alt="Ikona trudności">
                    </div>
                    <p>'.$trudnosc.'</p>
                </div>
                <div class="ikonki-box">
                    <div class="image-ikonka-box">
                        <img src="../images/person.svg" alt="Ikona osoby">
                    </div>
                    <p>'.$porcja.'</p>
                </div>
                <div class="ikonki-box">
                    <div class="image-ikonka-box">
                        <img src="../images/zegar_ikonka.svg" alt="Ikona zegara">
                    </div>
                    <p>'.$czas.'</p>
                </div>
            </div>
    
            <div class="skladniki">
                <ul>
                    '.$skladniki.'
                </ul>
            </div>
        </div>

        <div class="kolumna">
            <div class="zdjecie-przepisu">
                <img src="../images/dummy.png" alt="Zdjęcie przepisu" id="gallery-zdjecie">
                <div class="buttons-gallery">
                    <button><img src="../images/mniej_ikonka.svg" alt="Ikona strzałki w dół" id="button-gallery-lewo"></button>
                    <button><img src="../images/wiecej_ikonka.svg" alt="Ikona strzałki w górę" id="button-gallery-prawo"></button>
                </div>
            </div>
    
            <div class="przygotowanie-box">
                <h2>Przygotowanie krok po kroku:</h2>
                '.$kroki.'
            </div>
        </div>
    </div>
</main>

<script>
    let images = '.$zdjecia_list_txt.'
    document.title = "'.$row['nazwa'].'"
</script>

<footer>
    <p>Odwiedziny przepisu: '. $odwiedziny .'</p>
</footer>
    ';
?>