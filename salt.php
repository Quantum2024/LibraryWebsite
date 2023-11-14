<?php
function generateSecureSalt() {
    // Generate a secure random string of characters
    $length = 16;
    $salt = bin2hex(random_bytes($length));

    return $salt;
}


?>