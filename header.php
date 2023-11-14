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

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
</head>
<div class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-4">
                <div class="float-left">
                    <div class="sidebar-toggle m-t-20">
                        <i class="ti-angle-right f-s-20"></i>

                    </div>

                </div>
            </div>
            <div class="col-4 d-flex align-items-center text-center">
                <h3>Fortuna Library Management System</h3>
            </div>
            <div class="col-4">
                <div class="float-right">
                    <div class="dropdown dib">
                        <div class="header-icon" data-toggle="dropdown">
                            <button class="navbar-toggler" type="button" data-toggle="dropdown"
                                style="margin-right: 10px; color: black;">
                                <i class="fas fa-bars f-s-20"></i>
                            </button>
                            <div class="drop-down dropdown-profile dropdown-menu dropdown-menu-right">

                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <i class="ti-user"></i>
                                                <span>My Account Settings</span>
                                            </a>
                                        </li>
                                        <?php
                                        /*  if(user_session_user_type=librarian){
                                            echo "<li>
                                            <a href="admin_settings.php">
                                                <i class="ti-user"></i>
                                                <span>Admin Settings</span>
                                            </a>
                                            </li>"
                                        }
                                        */
                                        ?>
                                        <li>
                                            <a href="logout.php">
                                                <i class="ti-power-off"></i>
                                                <span>Logout</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>