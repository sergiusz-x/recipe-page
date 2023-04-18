<?php
    session_start();
    session_unset();
    header("Location: ./../html/index.php");
    echo '<script>alert("Pomyślnie wylogowano!")</script>'
?>