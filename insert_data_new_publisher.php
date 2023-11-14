<?php
// Include the database connection
include 'db_connection.php';
include 'session_check.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the HTML form
    $publisher_name = $_POST['publisher_name'];
    $publisher_country = $_POST['publisher_country'];
    $email_address = $_POST['email_address'];
    $phone_number = $_POST['phone_number'];

    // Insert data into the "publisher" table
    $insertPublisherQuery = "INSERT INTO publisher (publisher_name, publisher_country, email_address, phone_number) VALUES (?, ?, ?, ?)";

    $stmtPublisher = $mysqli->prepare($insertPublisherQuery);
    $stmtPublisher->bind_param("ssss", $publisher_name, $publisher_country, $email_address, $phone_number);

    // Execute the prepared statement
    if ($stmtPublisher->execute()) {
        echo "Publisher data inserted successfully.";
    } else {
        echo "Error: " . $mysqli->error;
    }

    // Close the prepared statement and the database connection
    $stmtPublisher->close();
    $mysqli->close();
}
?>
