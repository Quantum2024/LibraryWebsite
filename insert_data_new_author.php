<?php
//  Include the database connection
include 'db_connection.php';
include 'session_check.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the HTML form
    $author_first_name = $_POST['author_first_name'];
    $author_last_name = $_POST['author_last_name'];


    // Insert data into the "author" table
    $insertAuthorQuery = "INSERT INTO author (author_first_name, author_last_name) 
                    VALUES (?, ?)";

    $stmtAuthor = $mysqli->prepare($insertAuthorQuery);
    $stmtAuthor->bind_param("ss", $author_first_name, $author_last_name);

    // Execute the prepared statement
    if ($stmtAuthor->execute()) {
        echo "Author data inserted successfully.";
    } else {
        echo "Error: " . $mysqli->error;
    }

    // Close the prepared statement and the database connection
    $stmtAuthor->close();
    $mysqli->close();
}
?>
