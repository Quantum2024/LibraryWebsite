<?php

$host = "localhost";
$username = "eciraco";
$password = "eciraco6920";
$database = "LIS";

$mysqli = new mysqli($host, $username, $password, $database);

// Check connection
if ($mysqli->connect_error) {
    $message = "Connection failed: " . $mysqli->connect_error; // Use $mysqli here

    if (isset($_SERVER['HTTP_REFERER'])) {
        $referrer = $_SERVER['HTTP_REFERER'];
        header("Location: error_page.php?message=$message&return_page=$referrer");
    } else {
        die($message);
    }
    exit();
}
?>
