<?php
// Include the database connection
include 'db_connection.php';
include 'session_check.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the HTML form
    $book_isbn = $_POST['book_isbn'];
    $supplier_name = $_POST['supplier_name'];
    $unit_price = $_POST['unit_price'];
    $published_date = $_POST['published_date'];
    $book_condition = $_POST['book_condition'];

    // Insert data into the "copy" table
    $insertCopyQuery = "INSERT INTO copy (book_isbn, supplier_name, unit_price, published_date, book_condition) VALUES (?, ?, ?, ?, ?)";

    $stmtCopy = $mysqli->prepare($insertCopyQuery);
    $stmtCopy->bind_param("ssdss", $book_isbn, $supplier_name, $unit_price, $published_date, $book_condition);

    // Execute the prepared statement
    try {
    if ($stmtCopy->execute()) {
        echo "Copy data inserted successfully.";
    } else {
        echo "Error: " . $mysqli->error;
    }
} catch (Exception $e) {
    $response = array('error' => 'Something went wrong!');
    http_response_code(500); // Set HTTP status code to indicate an error
    header('Content-Type: application/json');
    echo json_encode($response);
}

    // Close the prepared statement and the database connection
    $stmtCopy->close();
    $mysqli->close();
}
?>
