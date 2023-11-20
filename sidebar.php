<?php

session_start();
// Perform the database query to retrieve first_name and last_name based on user_id
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    // Add your database connection code here
    include "db_connection.php";

    $sql = "SELECT first_name, last_name FROM user WHERE user_id = ?";
    $stmt = mysqli_prepare($mysqli, $sql);

    // Bind the user_id parameter
    mysqli_stmt_bind_param($stmt, "i", $userId);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Get the result
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $userName = $row['first_name'] . ' ' . $row['last_name'];


    } else {
        // Handle the case where user data is not found
        $userName = "User Not Found";
    }
    mysqli_stmt_close($stmt); // Close the prepared statement
} else {
    // Handle the case where the user is not logged in
    $userName = "Guest";
}
?>

<div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">

    <style>
        .nano-content ul li:not(.sidebar-sub-toggle) {
            margin-bottom: 20px;
            /* Adjust the value to control the spacing */
        }

        span.badge-bigger {
            font-size: .9rem;
            padding: 15px 20px;
            background-color: #AAD4E4 !important;
            color: white !important;
        }

        .social-media-container {
            position: absolute;
            bottom: 0;
        }

        @media (max-height: 698px) {
            .social-media-container {
                display: none;
            }
        }
    </style>
    <div class="nano">
        <div class="nano-content">
            <div class="logo" style="background: rgba(255, 255, 255, 0.5);"><a href="index.html">
                    <img src="images/Caribbean_PLL_Logo.png" height="150px" alt="" /> </a></div>
            <div class="text-center">
                <span class="badge sidebar-badge rounded-pill bg-secondary text-white badge-bigger m-3"><i
                        class="fas fa-user"></i>
                    <?php echo $userName; ?>
                </span>
            </div>
            <ul>

                <li><a href="dashboard.php"><i class="ti-home"></i> Dashboard </a></li>
                <li><a href="inventory.php"><i class="ti-book"></i> Inventory </a></li>
                <li><a class="sidebar-sub-toggle"><i class="ti-info-alt"></i> Book Status <span
                            class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li class="sidebar-sub-toggle"><a href="check_in.php">Check In Book</a></li>
                        <li class="sidebar-sub-toggle"><a href="check_out.php">Check Out Book</a></li>
                    </ul>
                </li>
                <li><a href="members.php"><i class="ti-user"></i> Members</a></li>
                <li><a href="settings.php"><i class="ti-settings"></i> Settings </a></li>
            </ul>
            <div class="social-media-container">
                <div class="row text-center mb-0">
                    <div class="col">
                        <p style="color: white !important;">Social Media Accounts</p>
                    </div>
                </div>
                <div class="row text-center pb-3">
                    <div class="col">
                        <a class="btn btn-primary" style="background-color: #3b5998; padding: 5px; font-size: .85rem"
                            href="https://www.facebook.com/profile.php?id=61552661021919" role="button" target="_blank"><i
                                class="fab fa-facebook-f"></i>Facebook</a>
                    </div>
                    <div class="col">
                        <a class="btn btn-primary" style="background-color: #ac2bac; padding: 5px; font-size: .85rem"
                            href="https://www.instagram.com/caribbean_library_project/" role="button"><i
                                class="fab fa-instagram" target="_blank"></i>Instagram</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /# sidebar -->