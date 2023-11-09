<?php
//  Include the database connection
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the HTML form
    $copy_id = $_POST['copy_id'];
    $supplier_name = $_POST['supplier'];
    $unit_price = $_POST['unit_price'];
    $published_date = $_POST['published_date'];
    $condition = $_POST['condition'];

    // Update the "copy" table
    $updateCopyQuery = "UPDATE `copy` SET `supplier_name`= ?, `unit_price`= ?, `published_date` = ?, `book_condition` = ? WHERE copy_id = ?";

    $stmt = $mysqli->prepare($updateCopyQuery);
    $stmt->bind_param("sissi", $supplier_name, $unit_price, $published_date, $condition, $copy_id);

    //

    // Execute the prepared statement
    try {
        if ($stmt->execute()) {
            $response = array('message' => "Copy data updated successfully.");
            header('Content-Type: application/json');
            echo json_encode($response);
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
    $stmt->close();
    $mysqli->close();
}
?>