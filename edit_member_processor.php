<?php
// Include the database connection
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the HTML form
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $DOB = $_POST['DOB'];
    $phone_number = $_POST['phone_number'];
    $email_address = $_POST['email_address'];
    $member_id = $_POST['member_id'];

    // Update the "member" table
    $updateMemberQuery = "UPDATE member SET first_name = ?, `last_name`= ?, `DOB`= ?, `phone_number` = ?, email_address = ? WHERE member_id = ?";

    $stmt = $mysqli->prepare($updateMemberQuery);
    $stmt->bind_param("sssssi", $first_name, $last_name, $DOB, $phone_number, $email_address, $member_id);

    // Execute the prepared statement
    try {
        if ($stmt->execute()) {
            $response = array('success' => 'Member data updated successfully.');
            http_response_code(200); // Set HTTP status code to indicate success
            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            error_log("SQL Error: " . $stmt->error); // Log SQL error
            $response = array('error' => 'Error updating member data.');
            http_response_code(500); // Set HTTP status code to indicate an error
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    } catch (Exception $e) {
        error_log("Error: " . $e->getMessage()); // Log the error
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
