<?php
include 'db_connection.php';
include 'session_check.php';
$query = "SELECT user_id, first_name, last_name, email, user_type FROM `user`";
$user_result = $mysqli->query($query);
//if the query returns any values, the copy is checked out, so it should be skipped
if ($user_result->num_rows > 0) {
    while ($row = $user_result->fetch_assoc()) {
        if ($row["user_id"] == $_SESSION["user_id"]) {
            echo "<tr>";
            echo "<td>" . $row['first_name'] . " " . $row["last_name"] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>Current User</td>";
            echo "</tr>";
        } else {
            echo "<tr>";
            echo "<td>" . $row['first_name'] . " " . $row["last_name"] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . "<a href= '#' id='change_user_type_button' class='badge badge-sm color-primary' user_id='" . $row["user_id"] . "' user_type='" . $row["user_type"] . "' user_name='" . $row["first_name"] . " " . $row["last_name"] . "' data-bs-toggle='modal' data-bs-target='#changeUserTypeModal'>Change User Type</a></br>
                                                                    <a href= '#' id='change_password' class='badge badge-sm color-warning' user_id='" . $row["user_id"] . "' first_name='" . $row["first_name"] . "' last_name='" . $row["last_name"] . "' data-bs-toggle='modal' data-bs-target='#resetPasswordModal'>Change Password</a></br>
                                                                    <a href= '#' id='delete_user' class='badge badge-sm color-danger' user_id='" . $row["user_id"] . "' onclick='deleteUser(this)'>Delete User</a>" .
                "</td>";
            echo "</tr>";
        }
    }
} else {
    echo "<tr>";
    echo "<td>No Users</td>";
    echo "<td></td>";
    echo "<td></td>";
    echo "</tr>";
}
$mysqli->close();
?>