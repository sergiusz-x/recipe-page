<?php
    require_once "connect.php";
    //
    $conn = @new mysqli($db_host, $db_user, $db_password, $db_name);
    if ($conn->connect_error) {
        echo "Odwiedzin strony: błąd - ";
        die("Connection failed: " . $conn->connect_error);
    }
    //
    $sql = "SELECT count_value FROM counter WHERE id = 1";
    $result = $conn -> query($sql);
    $row = $result -> fetch_assoc();
    //
    $count = $row["count_value"];;
    if(!$count) $count = 1;
    //
    if (!isset($_COOKIE["odwiedzone"])) {
        $count++;
        setcookie("odwiedzone", 1, time()+60*1);
        $query = "UPDATE counter SET count_value = $count WHERE id = 1";
        $conn->query($query);
    }
    //
    echo "Odwiedzin strony: $count";
    //
    $conn->close();
?>