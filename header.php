<html>
<?php
include "session_check.php"
?>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <style>
        .dropdown ul {
            display: none;
            position: absolute;
            background-color: #fff;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            list-style-type: none;
            padding: 0;
            margin: 0;
            right: 0;
            width: 300%;
            font-size: 0.9rem;
        }

        .dropdown ul li {
            padding: 8px 12px;
            cursor: pointer;
        }
    </style>
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
                        <div class="header-icon">
                            <i id="dropdownButton" class="fas fa-bars f-s-20"></i>
                            <ul id="dropdownList" style="width: 200px;"> <!-- Adjust the width as needed -->
                                <li style="white-space: nowrap;">
                                    <a href="settings.php">
                                        <i class="ti-user"></i>
                                        <span>Account Settings</span>
                                    </a>
                                </li>
                                <?php
                                if ($_SESSION['user_type'] == 2) {
                                    echo "<li>
                                        <a href='./admin_settings.php'>
                                            <i class='ti-settings'></i>
                                            <span>Admin Settings</span>
                                        </a>
                                      </li>";
                                }
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var dropdownButton = document.getElementById("dropdownButton");
            var dropdownList = document.getElementById("dropdownList");

            dropdownButton.addEventListener("click", function(event) {
                event.stopPropagation();
                dropdownList.style.display = (dropdownList.style.display === "none" || dropdownList.style.display === "") ? "block" : "none";
            });

            document.addEventListener("click", function(event) {
                var isClickInside = dropdownButton.contains(event.target) || dropdownList.contains(event.target);
                if (!isClickInside) {
                    dropdownList.style.display = "none";
                }
            });
        });
    </script>
</div>