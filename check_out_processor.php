<?php
// Include the database connection
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the HTML form
    $loaned_condition = $_POST['loaned_condition'];
    $currentDate = date("Y-m-d");
    $due_date= $_POST["due_date"];
    $member_id= $_POST["member_id"];
    $copy_id= $_POST['copy_id'];


    // Update condition in "copy" table
    $updateCopyQuery = "UPDATE `copy` SET book_condition = ? WHERE copy_id = ?";

    $stmtCopy = $mysqli->prepare($updateCopyQuery);
    $stmtCopy->bind_param("si", $loaned_condition, $copy_id);

    // Insert a new loan log entry
    $insertNewLLQuery = "INSERT INTO loan_log (member_id, date_checked_out, copy_id, due_date) VALUES (?, ?, ?, ?)";
    $stmtInsertNewLL = $mysqli->prepare($insertNewLLQuery);
    $stmtInsertNewLL->bind_param("isis", $member_id, $currentDate, $copy_id, $due_date);

    // Execute the prepared statement
    if ($stmtInsertNewLL->execute() && $stmtCopy->execute()) {
        error_log("Loan Log updated successfully.");
    } else {
        error_log("Error: " . $mysqli->error);
    }

    // Close the prepared statement and the database connection
    $stmtInsertNewLL->close();
    $mysqli->close();
    header("Location: check_out.php");
}
?>