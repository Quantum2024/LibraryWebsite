<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 0);
//  Include the database connection
include 'db_connection.php';
include 'session_check.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 0);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the HTML form
    $book_isbn = $_POST['book_isbn'];
    $book_title = $_POST['book_title'];
    $author_id = $_POST['author_id'];
    $edition = $_POST['edition'];
    $language = $_POST['language'];
    $genre_id = $_POST['genre_name_primary'];
    $publisher_id = $_POST['publisher_name'];
    $num_of_pages = $_POST['num_of_pages'];


    // Update the "book" table
    $updateBookQuery = "UPDATE book SET book_title = ?, `edition`= ?, `language`= ?, `genre_id` = ?, publisher_id = ?, num_of_pages = ? WHERE book_isbn = ?";

    $stmtBook = $mysqli->prepare($updateBookQuery);
    $stmtBook->bind_param("sssiiii", $book_title, $edition, $language, $genre_id, $publisher_id, $num_of_pages, $book_isbn);

    // Update the "wrote" table
    $updateWroteQuery = "UPDATE wrote SET author_id = ? WHERE book_isbn = ?";

    $stmtWrote = $mysqli->prepare($updateWroteQuery);
    $stmtWrote->bind_param("ii", $author_id, $book_isbn);

    //

    try {
        if ($stmtBook->execute() && $stmtWrote->execute()) {
            echo "Book data updated successfully.";
        } else {
            http_response_code(500);
            header('Content-Type: application/json');
            echo json_encode(array('success' => false, 'message' => $mysqli->error));
        }
    } catch (Exception $e) {
        $response = array('error' => 'Something went wrong!');
        http_response_code(500); // Set HTTP status code to indicate an error
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    // Close the prepared statement and the database connection
    $stmtBook->close();
    $mysqli->close();
}
?>