<?php
// łączymy się z bazą danych, zakładając że używamy MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "strona";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// sprawdzamy czy udało się połączyć z bazą danych
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// wykonujemy zapytanie, żeby pobrać dane z bazy
$sql = "SELECT * FROM przepisy";
$result = mysqli_query($conn, $sql);

// tworzymy pętlę, która wygeneruje boxy na stronie
if (mysqli_num_rows($result) > 0) {
  echo '<div class="boxes-wrapper">';

  // generujemy przyciski slidera
  echo '<div class="slider-controls">';
  echo '<button class="slider-btn prev-btn">Previous</button>';
  echo '<button class="slider-btn next-btn">Next</button>';
  echo '</div>';

  // generujemy każdy box na podstawie danych z bazy
  while($row = mysqli_fetch_assoc($result)) {
    echo '<div class="box">';
    echo '<a href="' . $row["link_url"] . '">';
    echo '<img src="' . $row["image_url"] . '" alt="Box Image">';
    echo '<p>' . $row["text"] . '</p>';
    echo '</a>';
    echo '</div>';
  }

  echo '</div>';
} else {
  echo "No data found in database";
}

// zamykamy połączenie z bazą danych
mysqli_close($conn);
?>