<?php
// Step 1: Establish a database connection
$host = "20.163.12.236:3306";
//$host = "localhost";
$username = "eciraco";
$password = "eciraco6920";
$database = "LIS";


$mysqli = new mysqli($host, $username, $password, $database);

// Check connection
if ($mysqli->connect_error) {
    $message = "Connection failed: " . $connection->connect_error;
   
            if (isset($_SERVER['HTTP_REFERER'])) {
                
                //$referrer = $_SERVER['HTTP_REFERER'];
                //header("Location: error_page.php?message=$message&return_page=$referrer");
            }else{
                echo $message;
            }
            exit();
}
?>