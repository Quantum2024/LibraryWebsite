<?php
// Include the database connection
include 'db_connection.php';
include 'session_check.php';
include 'salt.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the HTML form
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $salt= generateSecureSalt();
    $password_hash = password_hash($_POST['new_password'] . $salt, PASSWORD_BCRYPT);
    $email = $_POST['email'];
    $user_type = $_POST['user_type'];

    // Insert data into the "User" table
    $insertUserQuery = "INSERT INTO user (first_name, last_name, `password_hash`, salt, email, user_type) VALUES (?, ?, ?, ?, ?, ?)";

    $stmtUser = $mysqli->prepare($insertUserQuery);
    $stmtUser->bind_param("ssssss", $first_name, $last_name, $password_hash, $salt, $email, $user_type);

    // Execute the prepared statement
    try {
        if ($stmtUser->execute()) {
            echo "User data inserted successfully.";
        } else {
            echo "Error: " . $mysqli->error;
        }
    } catch (Exception $e) {
        $response = array('error' => $e->getMessage());
        http_response_code(500); // Set HTTP status code to indicate an error
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    // Close the prepared statement and the database connection
    $stmtUser->close();
    $mysqli->close();
}
?>
