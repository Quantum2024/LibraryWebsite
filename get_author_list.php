<?php
// Include the database connection
include 'db_connection.php';

// SQL query to retrieve author names
$query = "SELECT CONCAT(author_first_name, ' ', author_last_name) AS author_name FROM author";

// Perform the query
$result = $mysqli->query($query);

// Check for errors
if (!$result) {
    echo "Error: " . $mysqli->error;
} else {
    $options = "";
    // Fetch author names and create options
    while ($row = $result->fetch_assoc()) {
        $authorName = $row['author_name'];
        $options .= "<option value='$authorName'>$authorName</option>";
    }
    echo $options;
}
?>
