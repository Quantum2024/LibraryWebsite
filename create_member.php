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

    <link href="css/lib/themify-icons.css" rel="stylesheet">
    <link href="css/lib/owl.carousel.min.css" rel="stylesheet" />
    <link href="css/lib/owl.theme.default.min.css" rel="stylesheet" />
    <link href="css/lib/menubar/sidebar.css" rel="stylesheet">
    <link href="css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="css/lib/helper.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet">


    <link href="css/lib/font-awesome.min.css" rel="stylesheet">


</head>

<body>
    <?php include 'sidebar.php';
    include 'header.php'; ?>

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="card">

                    <div class="row mt-3">
                        <div class="col-lg-6">
                            <h1>Member Information</h1>
                        </div>
                        <!-- /# column -->
                        <div class="col-lg-6">
                            <div class="page-header">
                                <div class="page-title">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="edit_member.php">Inventory</a></li>
                                        <li class="breadcrumb-item active">Create Member</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    <section id="main-content">
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <form method="post" id="newMemberForm">
                                    <div class="mb-3">

                                        <div class="mb-3">
                                            <div class="row mb-3">
                                                <div class="col-4">
                                                    <label for="first_name" class="form-label">First Name</label>
                                                    <input type="text" id="first_name" name="first_name"
                                                        class="form-control">
                                                </div>
                                                <div class="col-4" id="supplier_col">
                                                    <label for="last_name" class="form-label">Last Name</label>
                                                    <input type="text" id="last_name" name="last_name"
                                                        class="form-control">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-4">
                                                <label for="phone_number" class="form-label">Phone Number</label>
                                                <input type="text" id="phone_number" name="phone_number"
                                                    class="form-control">
                                            </div>
                                            <div class="col-4">
                                                <label for="email_address" class="form-label">Email Address</label>
                                                <input type="email_address" id="email_address" name="email_address"
                                                    class="form-control">
                                            </div>
                                            <div class="col-4">
                                                <label for="date_of_birth" class="form-label">Date Of Birth</label>
                                                <input type="date" id="date_of_birth" name="date_of_birth"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                        <button type="submit" id="memberSubmission" 
                                                class="btn btn-primary text-nowrap mr-2 float-left">Save
                                                Member</button>

                                            <a href="members.php"><button type="button"
                                                    class="btn btn-secondary">Cancel</button><a
                                                    href="inventory.php"></a>
                                        </div>
                                    </div>
                                    
                                </form>

                            </div>

                        </div>
                    </section>
                </div>


            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="footer">
                <p>2023 © Fortuna <a href="#"></a></p>

            </div>


        </div>
    </div>




    <!-- jquery vendor -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/lib/jquery.nanoscroller.min.js"></script>
    <!-- nano scroller -->
    <script src="js/lib/menubar/sidebar.js"></script>
    <script src="js/lib/preloader/pace.min.js"></script>
    <!-- sidebar -->

    <script src="js/scripts.js"></script>
    <!-- bootstrap -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="create_member_processing.js"></script>
 <!-- validation-->
 <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>


</body>

</html>