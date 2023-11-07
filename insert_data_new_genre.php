<?php
// Include the database connection
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the HTML form
    $genre_name = $_POST['genre_name'];
    


    // Insert data into the "author" table
    $insertGenreQuery = "INSERT INTO genre (genre_name) 
                    VALUES (?)";

    $stmtGenre = $mysqli->prepare($insertGenreQuery);
    $stmtGenre->bind_param("s", $genre_name);

    // Execute the prepared statement
    if ($stmtGenre->execute()) {
        error_log("New Genre inserted successfully.");
    } else {
        error_log("Error: " . $mysqli->error);
    }

    // Close the prepared statement and the database connection
    $stmtGenre->close();
    $mysqli->close();
}
?>