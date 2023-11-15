<?php
session_start();
include "db_connection.php";
include "session_check.php";
include 'salt.php';

if (($_SESSION['user_type'] == 2) && isset($_POST['user_id'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $userId = $_POST['user_id'];
        // Check if all required fields are set
        $newPassword = $_POST['reset_new_password'];
        $retypePassword = $_POST['reset_retype_password'];

        if ($newPassword === $retypePassword) {
            // Generate a new salt and hash for the new password
            $newSalt = generateSecureSalt();
            $newHashedPassword = password_hash($newPassword . $newSalt, PASSWORD_BCRYPT);
            // Update the user's password in the database
            $updateSql = "UPDATE user SET password_hash = '$newHashedPassword', salt = '$newSalt' WHERE user_id = $userId";
            $updateResult = mysqli_query($mysqli, $updateSql);

            if ($updateResult) {
                // Return a success message
                echo 'Password updated successfully';
            } else {
                // Return an error message
                echo 'Error updating password: ' . mysqli_error($mysqli);
            }
        } else {
            // Return an error message
            echo 'New password and retype password do not match.';
        }
    }
} else if (!(isset($_POST['user_id']))) {
    $userId = $_SESSION['user_id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if all required fields are set
        if (isset($_POST['current_password'], $_POST['new_password'], $_POST['retype_password'])) {
            $currentPassword = $_POST['current_password'];
            $newPassword = $_POST['new_password'];
            $retypePassword = $_POST['retype_password'];

            // Validate the current password against the one stored in the database
            $sql = "SELECT password_hash, salt FROM user WHERE user_id = $userId";
            $result = mysqli_query($mysqli, $sql);

            if ($result) {
                $row = mysqli_fetch_assoc($result);

                // Validate current password
                if (password_verify($currentPassword . $row['salt'], $row['password_hash'])) {
                    // Current password is correct, proceed to update the password
                    if ($newPassword === $retypePassword) {
                        // Generate a new salt and hash for the new password
                        $newSalt = generateSecureSalt();
                        $newHashedPassword = password_hash($newPassword . $newSalt, PASSWORD_BCRYPT);

                        // Update the user's password in the database
                        $updateSql = "UPDATE user SET password_hash = '$newHashedPassword', salt = '$newSalt' WHERE user_id = $userId";
                        $updateResult = mysqli_query($mysqli, $updateSql);

                        if ($updateResult) {
                            // Return a success message
                            echo 'Password updated successfully';
                        } else {
                            // Return an error message
                            echo 'Error updating password: ' . mysqli_error($mysqli);
                        }
                    } else {
                        // Return an error message
                        echo 'New password and retype password do not match.';
                    }
                } else {
                    // Return an error message
                    echo 'Incorrect current password.';
                }
            } else {
                // Return an error message
                echo 'Error fetching user data: ' . mysqli_error($mysqli);
            }
        } else {
            // Return an error message
            echo 'All form fields are required.';
        }
    }
} else {
    // Return an error message
    echo 'ERROR: UNKNOWN.';
}

mysqli_close($mysqli);
?>