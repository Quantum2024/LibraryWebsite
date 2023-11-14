<?php

session_start();

include "db_connection.php";

if (isset($_POST['email']) && isset($_POST['password'])) {

    function validate($data)
    {

        $data = trim($data);

        $data = stripslashes($data);

        $data = htmlspecialchars($data);

        return $data;

    }

    $email = ($_POST['email']);

    $pass = ($_POST['password']);

    if (empty($email)) {
        header("Location: index.php?error=" . urlencode("Email is required"));
        $mysqli->close();
        exit();

    } else if (empty($pass)) {

        header("Location: index.php?error=" . urlencode("Password is required"));
        $mysqli->close();
        exit();

    } else {

        $sql = "SELECT * FROM user WHERE email='$email';";

        $result = mysqli_query($mysqli, $sql);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            if (strtolower($row['email']) == strtolower($email) && password_verify($pass . $row['salt'], $row['password_hash'])) {

                echo "Logged in!";

                $_SESSION['email'] = $row['email'];

                $_SESSION['name'] = $row['first_name'] . " " . $row["last_name"];

                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['user_type'] = $row['user_type'];

                header("Location: dashboard.php");
                $mysqli->close();
                exit();

            } else {

                header("Location: index.php?error=" . urlencode("Incorrect Email or Password"));
                $mysqli->close();
                exit();

            }

        } else {

            header("Location: index.php?error=" . urlencode("Incorect Email or password NOTHING IN DATATABLE"));
            $mysqli->close();
            exit();

        }

    }

} else {
    echo "nothing set";
    //header("Location: index.php?error=" . urlencode("Email and password cannot be empty"));
    $mysqli->close();
    exit();

}