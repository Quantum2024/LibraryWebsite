<?php
// Include the database connection
include 'db_connection.php';

// SQL query to retrieve publisher names
$query = "SELECT publisher_name FROM publisher";

// Perform the query
$result = $mysqli->query($query);

// Check for errors
if (!$result) {
    echo "Error: " . $mysqli->error;
} else {
    $options = "";
    // Fetch publisher names and create options
    while ($row = $result->fetch_assoc()) {
        $publisherName = $row['publisher_name'];
        $options .= "<option value='$publisherName'>$publisherName</option>";
    }
    echo $options;
}
?>
