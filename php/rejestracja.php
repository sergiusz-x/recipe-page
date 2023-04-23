<?php
    //
    header('Content-Type: application/json; charset=utf-8');
    $json_str = file_get_contents('php://input');
    $data_json = json_decode($json_str, true);
    //
    if(!isset($data_json['email']) || empty($data_json['email'])) { echo 'Uzupełnij e-mail #1!'; exit(); }
    if(!isset($data_json['pseudonim']) || $data_json['pseudonim'] === '') { echo 'Uzupełnij pseudonim #1!'; exit(); }
    if(!isset($data_json['password']) || empty($data_json['password'])) { echo 'Uzupełnij hasło #1!'; exit(); }
    //
    $email = $data_json['email'];
    $pseudonim = $data_json['pseudonim'];
    $password = $data_json['password'];
    //
    if(empty($email) || empty($pseudonim) || empty($password)) {
        echo "Błąd tworzenia konta #1!";
        exit();
    }
    //
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Nieprawidłowy adres e-mail!";
        exit();
    }
    //
    if(strlen($pseudonim) < 3 || strlen($pseudonim) > 20) {
        echo "Pseudonim powinien zawierać od 3 do 20 znaków!";
        exit();
    } else if(!preg_match('/^[a-zA-ZęóąśłżźćńĘÓĄŚŁŻŹĆŃ0-9]{3,20}$/', $pseudonim)) {
        echo "Pseudonim zawiera zabronione znaki!";
        exit();
    }
    //
    if (strlen($password) < 10 || strlen($password) > 25) {
        echo "Hasło powinno zawierać od 10 do 25 znaków!";
        exit();
    } else if (!preg_match('/^[a-zA-Z0-9!@#$%^&*()_\+=]{10,25}$/', $password)) {
        echo "Hasło zawiera zabronione znaki!";
        exit();
    } else if (!preg_match('/[!@#$%^&*()_\-+=]/', $password)) {
        echo "Hasło musi zawierać przynajmniej jeden znak specjalny!";
        exit();
    }
    //
    require_once "connect.php";
    $conn = @new mysqli($db_host, $db_user, $db_password, "strona");
    if ($conn->connect_error) {
        echo "Błąd tworzenia konta #2!";
        exit();
    }
    //
    $hashed_password = hash("sha256", $password."salt");
    //
    $email = mysqli_real_escape_string($conn, $email);
    $pseudonim = mysqli_real_escape_string($conn, $pseudonim);
    $hashed_password = mysqli_real_escape_string($conn, $hashed_password);
    //
    $query_szukaj = "SELECT * FROM users WHERE email = '$email' OR pseudonim = '$pseudonim'";
    $query_wstaw = "INSERT INTO users (pseudonim, email, haslo) VALUES ('$pseudonim', '$email', '$hashed_password')";
    //
    $keywordsqlinjection = array('update', 'truncate', 'delete', 'drop', 'create', ';', '--');
    $lowercase_query_szukaj = strtolower($query_szukaj);
    $lowercase_query_wstaw = strtolower($query_wstaw);
    foreach($keywordsqlinjection as $word) {
        if(strpos($lowercase_query_szukaj, $word) !== false) {
            echo "Błąd tworzenia konta #3!";
            exit();
        }
        if(strpos($lowercase_query_wstaw, $word) !== false) {
            echo "Błąd tworzenia konta #4!";
            exit();
        }
    }
    //
    //
    $result = $conn->query($query_szukaj);
    if($result->num_rows > 0) {
        $row = $result -> fetch_assoc();
        //
        if($row["pseudonim"] == $pseudonim) {
            echo "Użytkownik o podanym pseudonimie już istnieje!";
            exit();
        } else {
            echo "Użytkownik z podanym e-mailem już istnieje!";
            exit();
        }
    }
    //
    $result = $conn->query($query_wstaw);
    if ($result) {
        $id = $conn->insert_id;
        echo "Success: $id";
    } else {
        echo "Błąd tworzenia konta #5!";
        exit();
    }
?>