<?php
    session_start();
    if(!isset($_SESSION['id'])) {
        header("Location: ./../html/logowanie.php");
        exit();
    }
    $user_id = @$_SESSION['id'];
    require_once "connect.php";
    //
    $id_przepisu = @urldecode(@$_GET['id_przepisu']);
    if(!$id_przepisu || !is_numeric($id_przepisu)) {
        header("Location: ./../html/konto.php");
        exit();
    }
    //
    $conn = @new mysqli($db_host, $db_user, $db_password, $db_name);
    if ($conn->connect_error) {
        header("Location: ./../html/konto.php");
        exit();
    }
    //
    $query = "SELECT `id`, `autor_id` FROM `przepisy` WHERE id = $id_przepisu";
    $query = mysqli_real_escape_string($conn, $query);
    $results = $conn->query($query);
    //
    if (!$results || $results->num_rows == 0) {
        header("Location: ./../html/konto.php");
        exit();
    }
    //
    $row = $results->fetch_assoc();
    $row_autor_id = $row["autor_id"];
    $row_id = $row["id"];
    if($row_id && $row_autor_id == $user_id) {
        $query = "DELETE FROM `przepisy` WHERE `id` = $row_id";
        $query = mysqli_real_escape_string($conn, $query);
        $results = $conn->query($query);
        //
        $query = 'DELETE FROM `images` WHERE `przepis_id` = "'.$row_id.'"';
        $conn->query($query);
    }
    //
    $conn->close();
    //
    header("Location: ./../html/konto.php");
    exit();
?>