<?php
// Include the database connection
include 'db_connection.php';
include 'session_check.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION["user_type"]==2) {
    // Get data from the HTML form
    $user_id = $_POST['user_id'];

    // Insert data into the "User" table
    $deleteUserQuery = "DELETE FROM user WHERE user_id = ?;";

    $stmtUser = $mysqli->prepare($deleteUserQuery);
    $stmtUser->bind_param("i", $user_id);

    // Execute the prepared statement
    try {
        if ($stmtUser->execute()) {
            echo "User successfully deleted.";
        } else {
            echo "Error: " . $mysqli->error;
        }
    } catch (Exception $e) {
        $response = array('error' => $e->getMessage());
        http_response_code(500); // Set HTTP status code to indicate an error
        header('Content-Type: application/json');
        echo "Error: ".$e->getMessage();
    }

    // Close the prepared statement and the database connection
    $stmtUser->close();
    $mysqli->close();
}else{
    echo "Error: Access Denied";
}
?>