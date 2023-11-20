<?php
// Include the database connection
include 'db_connection.php';
include 'session_check.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the HTML form
    $loan_log_id = $_POST['loan_log_id'];
    $condition_returned = $_POST['condition_returned'];
    $currentDate = date("Y-m-d");
    $copy_id = $_POST['copy_id'];

    // Update date_returned in the "loan_log" table
    $updateLLQuery = "UPDATE loan_log SET date_checked_in = ? WHERE loan_log_id = ?";

    $stmtLL = $mysqli->prepare($updateLLQuery);
    $stmtLL->bind_param("ss", $currentDate, $loan_log_id);

    // Update condition in "copy" table
    $updateCopyQuery = "UPDATE `copy` SET book_condition = ? WHERE copy_id = ?";

    $stmtCopy = $mysqli->prepare($updateCopyQuery);
    $stmtCopy->bind_param("si", $condition_returned, $copy_id);

    // Execute the prepared statement
    if ($stmtLL->execute() && $stmtCopy->execute()) {
        error_log("Loan Log updated successfully.");
    } else {
        error_log("Error: " . $mysqli->error);
    }

    // Execute the prepared statement
    try {
        if ($stmtLL->execute() && $stmtCopy->execute()) {
            echo "Loan Log updated successfully.";
            http_response_code(200); // Set HTTP status code to indicate success
        } else {
            echo "Error: Loan Log update failed.";
            http_response_code(500); // Set HTTP status code to indicate success   
        }
    } catch (Exception $e) {
        $response = array('error' => $e->getMessage());
        http_response_code(500); // Set HTTP status code to indicate an error
        header('Content-Type: application/json');
        echo "Error: ".$e->getMessage(); 
    }

    // Close the prepared statement and the database connection
    $stmtLL->close();
    $stmtCopy->close();
    $mysqli->close();
}
?>