<?php
include 'db_connection.php';
include 'session_check.php';

$query = "SELECT author_first_name, author_last_name FROM `author`";
$author = $mysqli->query($query);

$data = array(); // Create an array to store the data

while ($row = $author->fetch_assoc()) {
    // Create an associative array for each row
    $entry = array(
        "id" => $row["author_first_name"] . " " . $row["author_last_name"],
        "text" => $row["author_first_name"] . " " . $row["author_last_name"]
    );

    // Add each entry to the data array
    $data[] = $entry;
}

$mysqli->close();

// Use json_encode to convert the data array to JSON format
$jsonData = json_encode($data);

// Print the JSON data
echo $jsonData;
?>