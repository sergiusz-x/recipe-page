<?php
    require_once "connect.php";
    //
    session_start();
    if(!isset($_SESSION['id'])) {
        echo "Błąd dodawania przepisu #0";
        exit();
    }
    $autor_id = $_SESSION['id'];
    //
    header('Content-Type: application/json; charset=utf-8');
    $json_str = file_get_contents('php://input');
    $data_json = json_decode($json_str, true);
    //
    //
    $conn = @new mysqli($db_host, $db_user, $db_password, "strona");
    if ($conn->connect_error) {
        echo "Błąd dodawania przepisu #1";
        exit();
    }
    //
    if(!isset($data_json['nazwa_przepisu']) || empty($data_json['nazwa_przepisu'])) { echo 'Brak wymaganych danych #1'; exit(); }
    if(!isset($data_json['trudnosc']) || $data_json['trudnosc'] === '') { echo 'Brak wymaganych danych #2'; exit(); }
    if(!isset($data_json['porcja']) || empty($data_json['porcja'])) { echo 'Brak wymaganych danych #3'; exit(); }
    if(!isset($data_json['czas_realizacji']) || empty($data_json['czas_realizacji'])) { echo 'Brak wymaganych danych #4'; exit(); }
    if(!isset($data_json['skladniki']) || empty($data_json['skladniki'])) { echo 'Brak wymaganych danych #5'; exit(); }
    if(!isset($data_json['przygotowanie']) || empty($data_json['przygotowanie'])) { echo 'Brak wymaganych danych #6'; exit(); }
    if(!isset($data_json['zdjecia']) || empty($data_json['zdjecia'])) { echo 'Brak wymaganych danych #7'; exit(); }
    //
    $id_przepisu = @$data_json['id_przepisu'];
    $nazwa_przepisu = $data_json['nazwa_przepisu'];
    $trudnosc = $data_json['trudnosc'];
    $porcja = $data_json['porcja'];
    $czas_realizacji = $data_json['czas_realizacji'];
    $skladniki = $data_json['skladniki'];
    $przygotowanie = $data_json['przygotowanie'];
    $zdjecia = $data_json['zdjecia'];
    $timestamp = time();
    //
    //
    function validate_data($nazwa_przepisu, $trudnosc, $porcja, $czas_realizacji, $skladniki, $przygotowanie, $zdjecia) {
        // Walidacja nazwy przepisu
        if (!is_string($nazwa_przepisu) || strlen($nazwa_przepisu) < 1 || strlen($nazwa_przepisu) > 50) {
            return false;
        }
        // Walidacja trudności
        if (!is_numeric($trudnosc) || $trudnosc < 0 || $trudnosc > 2) {
            return false;
        }
        // Walidacja porcji
        if (!is_numeric($porcja) || $porcja < 1 || $porcja > 30) {
            return false;
        }
        // Walidacja czasu realizacji
        if (!is_numeric($czas_realizacji) || $czas_realizacji < 5 || $czas_realizacji > 120) {
            return false;
        }
        // Walidacja składników
        if (!is_array($skladniki)) {
            return false;
        }
        foreach ($skladniki as $skladnik) {
            if (!is_array($skladnik) || !array_key_exists('nazwa', $skladnik) || !array_key_exists('wielkosc', $skladnik) || !array_key_exists('typ_wielkosci', $skladnik)) {
                return false;
            }
            if (!is_string($skladnik['nazwa']) || strlen($skladnik['nazwa']) < 1 || strlen($skladnik['nazwa']) > 40) {
                return false;
            }
            if (!is_numeric($skladnik['wielkosc']) || $skladnik['wielkosc'] < 0) {
                return false;
            }
            $dozwolone_typy_wielkosci = ['g', 'kg', 'ml', 'L', 'szt.'];
            if (!in_array($skladnik['typ_wielkosci'], $dozwolone_typy_wielkosci)) {
                return false;
            }
        }
        // Walidacja przygotowania
        if (!is_array($przygotowanie)) {
            return false;
        }
        foreach ($przygotowanie as $krok) {
            if (!is_string($krok) || strlen($krok) < 1 || strlen($krok) > 1000) {
                return false;
            }
        }
        // Walidacja zdjęć
        if (!is_array($zdjecia)) {
            return false;
        }
        foreach ($zdjecia as $zdjecie) {
            if (!is_string($zdjecie) || strlen($zdjecie) < 1) {
                return false;
            }
        }
        //
        return true;
    }
    if(!validate_data($nazwa_przepisu, $trudnosc, $porcja, $czas_realizacji, $skladniki, $przygotowanie, $zdjecia)) {
        echo "Błąd dodawania przepisu #2";
        exit();
    }
    //
    $skladniki = json_encode($data_json['skladniki'], JSON_UNESCAPED_UNICODE);
    $przygotowanie = json_encode($data_json['przygotowanie'], JSON_UNESCAPED_UNICODE);
    //
    //
    //
    $zapisane_zdjecia = [];
    $photosDir = __DIR__ . '\\..\\images\\przepisy\\';
    //
    function isImage($file) {
        $size = getimagesize($file);
        $allowedFormats = ['image/jpeg', 'image/png'];
        return ($size && in_array($size['mime'], $allowedFormats));
    }
    function isFileSizeValid($file) {
        $fileSize = filesize($file);
        $maxFileSize = 5 * 1024 * 1024; // 5 MB
        return ($fileSize < $maxFileSize);
    }
    //
    $fraza_zdjecie_zapisane = "./../images/przepisy/";
    foreach($zdjecia as $photo) {
        if(strpos($photo, $fraza_zdjecie_zapisane) === 0) {
            $zapisane_zdjecia[] = str_replace($fraza_zdjecie_zapisane, "", $photo);
        } else {
            $tmpFilePath = tempnam(sys_get_temp_dir(), 'img');
            $imgData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $photo));
            file_put_contents($tmpFilePath, $imgData);
            //
            if(!isImage($tmpFilePath)) continue;
            if(!isFileSizeValid($tmpFilePath)) continue;
            //
            $randomName = 'zdjecie-przepisu-' . bin2hex(random_bytes(6)) . '-' . time() . '.jpg';
            //
            $extension = pathinfo($tmpFilePath, PATHINFO_EXTENSION);
            $randomName = str_replace($extension, "", $randomName);
            //
            $filePath = $photosDir . $randomName;
            //
            if(rename($tmpFilePath, $filePath)) {
                $zapisane_zdjecia[] = $randomName;
            } else {
                @unlink($tmpFilePath);
            }
        }
        //
    }
    if(empty($zapisane_zdjecia)) {
        $zapisane_zdjecia[] = "../dummy.png";
    }
    $zapisane_zdjecia_txt = json_encode($zapisane_zdjecia);
    //
    //
    //
    $nazwa_przepisu = mysqli_real_escape_string($conn, $nazwa_przepisu);
    $trudnosc = mysqli_real_escape_string($conn, $trudnosc);
    $porcja = mysqli_real_escape_string($conn, $porcja);
    $czas_realizacji = mysqli_real_escape_string($conn, $czas_realizacji);
    $skladniki = mysqli_real_escape_string($conn, $skladniki);
    $przygotowanie = mysqli_real_escape_string($conn, $przygotowanie);
    $zapisane_zdjecia_txt = mysqli_real_escape_string($conn, $zapisane_zdjecia_txt);
    //
    $query = "INSERT INTO przepisy (autor_id, nazwa, trudnosc, porcja, czas_realizacji, skladniki, przygotowanie, zdjecia, timestamp, counter_odwiedzin) VALUES ('$autor_id', '$nazwa_przepisu', '$trudnosc', '$porcja', '$czas_realizacji', '$skladniki', '$przygotowanie', '$zapisane_zdjecia_txt', '$timestamp', 0)";
    $czy_istnieje = 0;
    if($id_przepisu && is_numeric($id_przepisu)) {
        $query_szukaj_przepis = "SELECT * FROM `przepisy` WHERE id = $id_przepisu";
        $query_szukaj_przepis = mysqli_real_escape_string($conn, $query_szukaj_przepis);
        $results = $conn->query($query_szukaj_przepis);
        //
        if ($results && $results->num_rows > 0) {
            $row = $results->fetch_assoc();
            $row_id = $row["id"];
            $row_autor_id = $row["autor_id"];
            if($row_id && $row_autor_id == $autor_id) {
                //
                $czy_istnieje = $row_id;
                $query = "UPDATE `przepisy` SET `nazwa`='$nazwa_przepisu', `trudnosc`=$trudnosc, `porcja`=$porcja, `czas_realizacji`=$czas_realizacji, `skladniki`='$skladniki', `przygotowanie`='$przygotowanie', `zdjecia`='$zapisane_zdjecia_txt' WHERE `id` = $row_id";
                //
            }
        }
        //
    }
    //
    $keywordsqlinjection = array('select', 'truncate', 'delete', 'drop', 'create', ';', '--');
    $lowercase_query = strtolower($query);
    foreach($keywordsqlinjection as $word) {
        if(strpos($lowercase_query, $word) !== false) {
            echo "Błąd dodawania przepisu #3";
            exit();
        }
    }
    //
    $result = $conn->query($query);
    if ($result) {
        $id = $conn->insert_id;
        if($czy_istnieje > 0) {
            $id = $czy_istnieje;
        }
        echo "$id";
    } else {
        echo "Błąd dodawania przepisu #4";
    }
    //
    $conn->close();
    //
?>