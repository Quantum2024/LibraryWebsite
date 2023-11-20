<?php
// Include the database connection
include 'db_connection.php';
include 'session_check.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the HTML form
    $loaned_condition = $_POST['loaned_condition'];
    $currentDate = date("Y-m-d");
    $due_date = $_POST["due_date"];
    $member_id = $_POST["member_id"];
    $copy_id = $_POST['copy_id'];


    // Update condition in "copy" table
    $updateCopyQuery = "UPDATE `copy` SET book_condition = ? WHERE copy_id = ?";

    $stmtCopy = $mysqli->prepare($updateCopyQuery);
    $stmtCopy->bind_param("si", $loaned_condition, $copy_id);

    // Insert a new loan log entry
    $insertNewLLQuery = "INSERT INTO loan_log (member_id, date_checked_out, copy_id, due_date) VALUES (?, ?, ?, ?)";
    $stmtInsertNewLL = $mysqli->prepare($insertNewLLQuery);
    $stmtInsertNewLL->bind_param("isis", $member_id, $currentDate, $copy_id, $due_date);

    // Execute the prepared statement
    try {
        if ($stmtInsertNewLL->execute() && $stmtCopy->execute()) {
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
        echo "Error: " . $e->getMessage();
    }

    // Close the prepared statement and the database connection
    $stmtInsertNewLL->close();
    $stmtCopy->close();
    $mysqli->close();
}
?>