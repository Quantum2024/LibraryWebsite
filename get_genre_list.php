<?php include 'db_connection.php';
include 'session_check.php';
// Fetch genres from the database
$genreQuery = "SELECT genre_name FROM genre";
$genreResult = mysqli_query($mysqli, $genreQuery);

if ($genreResult) {
    while ($row = mysqli_fetch_assoc($genreResult)) {
        echo "<option value='" . $row['genre_name'] . "'>" . $row['genre_name'] . "</option>";
    }
} else {
    echo "Error: " . mysqli_error($mysqli);
}
?>