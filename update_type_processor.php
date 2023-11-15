<?php
//  Include the database connection
include 'db_connection.php';
include 'session_check.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION["user_type"]==2) {
    // Get data from the HTML form
    $user_id = $_POST['user_id'];
    $user_type = $_POST['user_type_select'];

    // Update the "copy" table
    $updateQuery = "UPDATE `user` SET `user_type`= ? WHERE user_id = ?";

    $stmt = $mysqli->prepare($updateQuery);
    $stmt->bind_param("ii", $user_type, $user_id);

    //

    // Execute the prepared statement
    try {
        if ($stmt->execute()) {
           echo "User Type data updated successfully.";
        } else {
            echo $mysqli->error;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
        http_response_code(500); // Set HTTP status code to indicate an error
    }

    // Close the prepared statement and the database connection
    $stmt->close();
    $mysqli->close();
}else{
    echo "Error: Access Denied";
}
?>