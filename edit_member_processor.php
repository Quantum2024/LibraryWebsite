<?php
//  Include the database connection
include 'db_connection.php';
include 'session_check.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the HTML form
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $DOB = $_POST['DOB'];
    $phone_number = $_POST['phone_number'];
    $email_address = $_POST['email_address'];
    $member_id = $_POST['member_id'];

    // Update the "book" table
    $updateMemberQuery = "UPDATE member SET first_name = ?, `last_name`= ?, `DOB`= ?, `phone_number` = ?, email_address = ? WHERE member_id = ?";

    $stmt = $mysqli->prepare($updateMemberQuery);
    $stmt->bind_param("sssssi", $first_name, $last_name, $DOB, $phone_number, $email_address, $member_id);

    //

    // Execute the prepared statement
    try {
        if ($stmt->execute()) {
            $response = array('message' => "Member data updated successfully.");
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