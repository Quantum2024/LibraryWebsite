<?php
include 'db_connection.php';
include 'session_check.php';

if (isset($_GET['member_id'])) {
    $member_id = $_GET['member_id'];

    // Create the SQL query with a parameter placeholder
    $query = "SELECT * FROM loan_log WHERE date_checked_in IS NULL AND due_date < CURDATE() AND member_id = ?";

    // Prepare the statement
    $stmt = $mysqli->prepare($query);

    if ($stmt) {
        // Bind the parameter
        $stmt->bind_param("i", $member_id); // Assuming member_id is an integer, use "i" for integer, or "s" for string
        // Execute the prepared statement
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                echo json_encode(array("overdue" => 1));
            } else {
                echo json_encode(array("overdue" => 0));
            }
        } else {
            echo json_encode(array("error" => "Query execution failed"));
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        echo json_encode(array("error" => "Preparation of the statement failed"));
    }
} else {
    echo json_encode(array("error" => "Invalid input"));
}
?>