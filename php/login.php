<?php
    session_start();
    //
    header('Content-Type: application/json; charset=utf-8');
    $json_str = file_get_contents('php://input');
    $data_json = json_decode($json_str, true);
    //
    if(!isset($data_json['email']) || empty($data_json['email'])) { echo 'Uzupełnij e-mail #1!'; exit(); }
    if(!isset($data_json['password']) || empty($data_json['password'])) { echo 'Uzupełnij hasło #1!'; exit(); }
    //
    $email = $data_json['email'];
    $password = $data_json['password'];
    //
    if(empty($email) ||  empty($password)) {
        echo "Błąd logowania #1!";
        exit();
    }
    //
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Nieprawidłowy adres e-mail!";
        exit();
    }
    //
    if(strlen($password) < 10 || strlen($password) > 25) {
        echo "Błędne dane logowania!";
        exit();
    }
    //
    //
    require_once "connect.php";
    $conn = @new mysqli($db_host, $db_user, $db_password, "strona");
    if ($conn->connect_error) {
        echo "Błąd logowania #2!";
        exit();
    }
    //
    $hashed_password = hash("sha256", $password."salt");
    //
    $email = mysqli_real_escape_string($conn, $email);
    $hashed_password = mysqli_real_escape_string($conn, $hashed_password);
    //
    $query_szukaj = "SELECT * FROM users WHERE email = '$email' AND haslo = '$hashed_password'";
    //
    $keywordsqlinjection = array('insert', 'truncate', 'update', 'delete', 'drop', 'create', ';', '--');
    $lowercase_query_szukaj = strtolower($query_szukaj);
    foreach($keywordsqlinjection as $word) {
        if(strpos($lowercase_query_szukaj, $word) !== false) {
            echo "Błąd logowania #3!";
            exit();
        }
    }
    //
    //
    $result = $conn->query($query_szukaj);
    if($result->num_rows > 0) {
        $row = $result -> fetch_assoc();
        //
        $id = $row['id'];
        $_SESSION['id'] = $id;
        echo "Success: $id";
    } else {
        echo "Błędne dane logowania!";
        exit();
    }
    //
?>