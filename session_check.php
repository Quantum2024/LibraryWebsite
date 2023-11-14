<?php
session_start();

// Check if the user is logged in
function isUserLoggedIn()
{
    return isset($_SESSION['user_id']);
}

// Check if the user is not logged in and redirect to the login page
function checkAuthentication()
{
    if (!isUserLoggedIn()) {
        header('Location: index.php');
        exit();
    }
}

checkAuthentication();
?>