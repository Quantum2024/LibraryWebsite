<?php
// Include the database connection
include 'db_connection.php';
include 'session_check.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the HTML form
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];
    $email_address = $_POST['email_address'];
    $date_of_birth = $_POST['date_of_birth'];

    // Insert data into the "member" table
    $insertMemberQuery = "INSERT INTO member (first_name, last_name, phone_number, email_address, DOB) VALUES (?, ?, ?, ?, ?)";

    $stmtMember = $mysqli->prepare($insertMemberQuery);
    $stmtMember->bind_param("ssiss", $first_name, $last_name, $phone_number, $email_address, $date_of_birth);

    // Execute the prepared statement
    try {
        if ($stmtMember->execute()) {
            echo "Member data inserted successfully.";
        } else {
            echo "Error: " . $mysqli->error;
        }
    } catch (Exception $e) {
        $response = array('error' => 'Something went wrong!');
        http_response_code(500); // Set HTTP status code to indicate an error
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    // Close the prepared statement and the database connection
    $stmtMember->close();
    $mysqli->close();
}
?>
