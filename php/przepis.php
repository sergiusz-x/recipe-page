<?php
    require_once "connect.php";
    //
    $conn = @new mysqli($db_host, $db_user, $db_password, "strona");
    if ($conn->connect_error) {
        echo "Błąd bazy danych!";
        exit();
    }
    //
?>