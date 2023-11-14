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
    include 'db_connection.php'; ?>

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="card">

                    <div class="row mt-3">
                        <div class="col-lg-8">
                            <h1>Administrative Settings</h2>
                        </div>
                        <!-- /# column -->
                        <div class="col-lg-4">
                            <div class="page-header">
                                <div class="page-title">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                        <li class="breadcrumb-item active">Administrative Settings</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->

                    <!-- /# row -->
                    <section id="main-content">
                        <div class="modal fade" id="createUserModal" tabindex="-1"
                            aria-labelledby="createUserModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="resetPasswordLabel">Create New User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Your form field here -->
                                        <form id="create_user_form">
                                            <div class="col mb-3">
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <label for="first_name" class="form-label">First Name</label>
                                                        <input type="text" id="first_name" name="first_name"
                                                            class="form-control">
                                                    </div>
                                                    <div class="col">
                                                        <label for="last_name" class="form-label">Last Name</label>
                                                        <input type="text" id="last_name" name="last_name"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="email" id="email" name="email"
                                                            class="form-control">
                                                    </div>
                                                    <div class="col">
                                                        <label for="user_type" class="form-label">User Type</label>
                                                        <select id="user_type" name="user_type" class="form-control">
                                                            <?php
                                                            $query = 'SELECT * FROM user_type';
                                                            $result = $mysqli->query($query);
                                                            if ($result->num_rows == 0) {
                                                                echo '<option selected>Error</option>';
                                                            } else {
                                                                echo '<option selected>Select a User Type</option>';
                                                                while ($row = $result->fetch_assoc()) {
                                                                    echo "<option value=" . $row["user_type_id"] . ">" . $row["user_type_name"] . "</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label for="new_password" class="form-label">Password</label>
                                                        <input type="password" id="new_password" name="new_password"
                                                            class="form-control">
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="retype_password" class="form-label">Confirm
                                                            Password</label>
                                                        <input type="password" id="retype_password"
                                                            name="retype_password" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" id="submit_new_user" class="btn btn-primary">Create
                                            User</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="table-responsive">
                                <div class="col">
                                    <div class="row">
                                        <h3 class="text-center">User Management</h3>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <button type="button" class="btn btn-sm btn-primary float-right"
                                                data-bs-toggle='modal' data-bs-target='#createUserModal'>Create New
                                                User</button>
                                        </div>
                                    </div>
                                    <table id="user-table" class="table table-striped table-bordered"
                                        style="margin-top: 10px">
                                        <thead>
                                            <tr>
                                                <th>User</th>
                                                <th>Email</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="users-table-body">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="export-options" style="margin-top: 20px">
                                <p>Export as: </p>
                            </div>
                        </div>

                    </section>
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

    <!-- jquery vendor -->
    <script src="js/lib/jquery.min.js"></script>
    <script src="js/lib/jquery.nanoscroller.min.js"></script>
    <!-- nano scroller -->
    <script src="js/lib/menubar/sidebar.js"></script>
    <script src="js/lib/preloader/pace.min.js"></script>
    <!-- sidebar -->
    <script src="js/lib/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
    <!-- bootstrap -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <!-- scripit init-->

    <script src="js/lib/data-table/datatables.min.js"></script>
    <script src="js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="js/lib/data-table/buttons.flash.min.js"></script>
    <script src="js/lib/data-table/jszip.min.js"></script>
    <script src="js/lib/data-table/pdfmake.min.js"></script>
    <script src="js/lib/data-table/vfs_fonts.js"></script>
    <script src="js/lib/data-table/buttons.html5.min.js"></script>
    <script src="js/lib/data-table/buttons.print.min.js"></script>
    <script src="js/lib/data-table/datatables-init.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="create_user_processing.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</body>

</html>