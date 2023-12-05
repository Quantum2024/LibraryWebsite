<?php
// Include the database connection
include 'db_connection.php';
include 'session_check.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION["user_type"] != 1) {
    // Get data from the HTML form
    $book_isbn = $_POST['book_isbn'];

    // Insert data into the "User" table
    $deleteQuery = "DELETE FROM book WHERE book_isbn = ?;";

    $stmt = $mysqli->prepare($deleteQuery);
    $stmt->bind_param("i", $book_isbn);

    // Execute the prepared statement
    try {
        if ($stmt->execute()) {
            echo "Book successfully deleted.";
        } else {
            echo "Error: " . $mysqli->error;
        }
    } catch (Exception $e) {
        $response = array('error' => $e->getMessage());
        http_response_code(500); // Set HTTP status code to indicate an error
        header('Content-Type: application/json');
        echo "Error: " . $e->getMessage();
    }

    // Close the prepared statement and the database connection
    $stmt->close();
    $mysqli->close();
} else {
    echo "Error: Access Denied";
}
?>