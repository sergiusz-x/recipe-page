<?php
    session_start();
    if(!isset($_SESSION['id'])) {
        exit();
    }
    $user_id = @$_SESSION['id'];
    require_once "connect.php";
    //
    header('Content-Type: application/json; charset=utf-8');
    $json_str = file_get_contents('php://input');
    $data_json = json_decode($json_str, true);
    if(!isset($data_json['id']) || empty($data_json['id']) || !is_numeric($data_json['id'])) {
        exit();
    }
    $id_przepisu = $data_json['id'];
    //
    $conn = @new mysqli($db_host, $db_user, $db_password, $db_name);
    if ($conn->connect_error) {
        exit();
    }
    //
    $query = "SELECT * FROM `przepisy` WHERE id = $id_przepisu";
    $query = mysqli_real_escape_string($conn, $query);
    $results = $conn->query($query);
    //
    if (!$results || $results->num_rows == 0) {
        exit();
    }
    //
    $conn->close();
    //
    $row = $results->fetch_assoc();
    $row_autor_id = $row["autor_id"];
    $row_id = $row["id"];
    if($row_id && $row_autor_id == $user_id) {
        $json = json_encode($row, JSON_UNESCAPED_UNICODE);
        echo "$json";
    }
    exit();
?>