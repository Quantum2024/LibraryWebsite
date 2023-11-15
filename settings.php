<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- theme meta -->
    <meta name="theme-name" content="focus" />
    <title>Caribbean Library Management System</title>
    <!-- ================= Favicon ================== -->
    <!-- Standard -->
    <link rel="shortcut icon" href="http://placehold.it/64.png/000/fff">
    <!-- Retina iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="144x144" href="http://placehold.it/144.png/000/fff">
    <!-- Retina iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="114x114" href="http://placehold.it/114.png/000/fff">
    <!-- Standard iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="72x72" href="http://placehold.it/72.png/000/fff">
    <!-- Standard iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="57x57" href="http://placehold.it/57.png/000/fff">
    <!-- Styles -->
    <link href="css/lib/chartist/chartist.min.css" rel="stylesheet">
    <link href="css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="css/lib/themify-icons.css" rel="stylesheet">
    <link href="css/lib/owl.carousel.min.css" rel="stylesheet" />
    <link href="css/lib/owl.theme.default.min.css" rel="stylesheet" />
    <link href="css/lib/menubar/sidebar.css" rel="stylesheet">
    <link href="css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="css/lib/helper.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet">

</head>

<body>
    <?php include 'sidebar.php';
    include 'header.php';
    //Just checking user id
    if (isset($_SESSION['user_id'])) {
        echo '<script>';
        echo 'console.log("User ID: ' . $_SESSION['user_id'] . '");';
        echo '</script>';
    }
    ?>



    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="card">

                    <div class="row mt-3">
                        <div class="col-lg-8">
                            <h1>User Settings</h2>
                        </div>
                        <!-- /# column -->
                        <div class="col-lg-4">
                            <div class="page-header">
                                <div class="page-title">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                        <li class="breadcrumb-item active">User Settings</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->

                    <!-- /# row -->
                    <section id="main-content">
                        <div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-labelledby="resetPasswordModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="resetPasswordLabel">Reset your Password</h5>
                                        <a href="#" data-bs-dismiss="modal">
                                            <i class="fas fa-x" style="outline: none"></i>
                                        </a>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Your form field here -->
                                        <form method="post" id="resetPasswordForm" >
                                            <div class="mb-3">
                                                <div class="row mb-3">
                                                    <label for="current_password" class="form-label">Current Password</label>
                                                    <input type="password" id="current_password" name="current_password" class="form-control">
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="new_password" class="form-label">New Password</label>
                                                    <input type="password" id="new_password" name="new_password" class="form-control">
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="retype_password" class="form-label">Retype New Password</label>
                                                    <input type="password" id="retype_password" name="retype_password" class="form-control">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" id="changePasswordButton" class="btn btn-primary">Change Password</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <?php

                                include "db_connection.php";

                                // Assuming you have a valid user_id in the session
                                if (isset($_SESSION['user_id'])) {
                                    $userId = $_SESSION['user_id'];

                                    // Query to fetch user details with user type information
                                    $sql = "SELECT u.first_name, u.last_name, u.email, ut.user_type_name
            FROM user u
            INNER JOIN user_type ut ON u.user_type = ut.user_type_id
            WHERE u.user_id = $userId";

                                    $result = mysqli_query($mysqli, $sql);

                                    if ($result) {
                                        $row = mysqli_fetch_assoc($result);

                                        // Example of echoing the results into your form
                                        echo '<form>';

                                        echo '<div class="mb-3">';
                                        echo '<div class="row mb-3">';
                                        echo '<div class="col">';
                                        echo '<label for="first_name" class="form-label">First Name</label>';
                                        echo '<input type="text" id="first_name" name="first_name" class="form-control" value="' . $row['first_name'] . '" readonly>';
                                        echo '</div>';

                                        echo '<div class="col">';
                                        echo '<label for="last_name" class="form-label">Last Name</label>';
                                        echo '<input type="text" id="last_name" name="last_name" class="form-control" value="' . $row['last_name'] . '" readonly>';
                                        echo '</div>';

                                        echo '</div>';

                                        echo '<div class="row mb-4">';
                                        echo '<div class="col">';
                                        echo '<label for="role" class="form-label">Role</label>';
                                        echo '<input type="text" id="role" name="role" class="form-control" value="' . $row['user_type_name'] . '" readonly>';
                                        echo '</div>';

                                        echo '<div class="col">';
                                        echo '<label for="email_address" class="form-label">Email Address</label>';
                                        echo '<input type="email" id="email_address" name="email_address" class="form-control" value="' . $row['email'] . '" readonly>';
                                        echo '</div>';

                                        echo '</div>';
                                        echo '</div>';

                                        echo '</form>';
                                    } else {
                                        echo 'Error executing query: ' . mysqli_error($mysqli);
                                    }

                                    mysqli_close($mysqli);
                                } else {
                                    echo 'User not logged in.';
                                }
                                ?>

                                <div class="row mb-4">
                                    <div class="col-1 mr-2">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-user_id="" data-target="#resetPasswordModal">Reset
                                            Password</button>
                                    </div>



                                    <div class="col-1 ml-2">
                                        <button type="button" class="btn btn-secondary">Close</button>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="footer">
                                    <p>2018 © Admin Board. - <a href="#">example.com</a></p>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <!-- jquery vendor  and sweet alert2-->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="js/lib/jquery.nanoscroller.min.js"></script>
        <!-- nano scroller -->
        <script src="js/lib/menubar/sidebar.js"></script>
        <script src="js/lib/preloader/pace.min.js"></script>
        <!-- sidebar -->
        <script src="js/lib/bootstrap.min.js"></script>
        <script src="js/scripts.js"></script>
        <!-- bootstrap -->

        <script src="js/lib/circle-progress/circle-progress.min.js"></script>
        <script src="js/lib/circle-progress/circle-progress-init.js"></script>
        <script src="js/lib/chartist/chartist.min.js"></script>
        <script src="js/lib/sparklinechart/jquery.sparkline.min.js"></script>
        <script src="js/lib/sparklinechart/sparkline.init.js"></script>

        <!-- scripit init-->
        <script src="js/dashboard2.js"></script>

        <script src="js/lib/data-table/datatables.min.js"></script>
        <script src="js/lib/data-table/dataTables.buttons.min.js"></script>
        <script src="js/lib/data-table/buttons.flash.min.js"></script>
        <script src="js/lib/data-table/jszip.min.js"></script>
        <script src="js/lib/data-table/pdfmake.min.js"></script>
        <script src="js/lib/data-table/vfs_fonts.js"></script>
        <script src="js/lib/data-table/buttons.html5.min.js"></script>
        <script src="js/lib/data-table/buttons.print.min.js"></script>
        <script src="js/lib/data-table/datatables-init.js"></script>
        <script src="reset_password.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                // Initialize Bootstrap modal
                var resetPasswordModal = new bootstrap.Modal(document.getElementById('resetPasswordModal'));

                // Handle modal shown event
                resetPasswordModal._element.addEventListener('shown.bs.modal', function() {


                });
            });
        </script>


</body>

</html>