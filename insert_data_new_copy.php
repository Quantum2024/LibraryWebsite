<?php
// Include the database connection
include 'db_connection.php';

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
    if ($stmtCopy->execute()) {
        echo "Copy data inserted successfully.";
    } else {
        echo "Error: " . $mysqli->error;
    }

    // Close the prepared statement and the database connection
    $stmtCopy->close();
    $mysqli->close();
}
?>
