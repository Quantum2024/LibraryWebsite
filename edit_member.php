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
    include 'header.php'; ?>

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="card">

                    <div class="row mt-3">
                        <div class="col-lg-6">
                            <h1>Member 11234545's Information</h2>
                        </div>
                        <!-- /# column -->
                        <div class="col-lg-6">
                            <div class="page-header">
                                <div class="page-title">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="members.php">Members</a></li>
                                        <li class="breadcrumb-item active">Edit Member</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->

                    <!-- /# row -->
                    <section id="main-content">
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <form>
                                    <div class="mb-3">
                                        <div class="row mb-3">
                                            <div class="col">
                                                <label for="first_name" class="form-label">First Name</label>
                                                <input type="text" id="first_name" name="first_name"
                                                    class="form-control">
                                            </div>
                                            <div class="col">
                                                <label for="last_name" class="form-label">Last Name</label>
                                                <input type="text" id="last_name" name="last_name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <label for="DOB" class="form-label">Date of Birth</label>
                                                <input type="date" id="DOB" name="DOB" class="form-control">
                                            </div>
                                            <div class="col">
                                                <label for="phone_number" class="form-label">Phone Number</label>
                                                <input type="text" id="phone_number" name="phone_number"
                                                    class="form-control">
                                            </div>
                                            <div class="col">
                                                <label for="email_address" class="form-label">Email Address</label>
                                                <input type="email" id="email_address" name="email_address"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="row">
                                    <div class="col-1">
                                        <button type="button" class="btn btn-primary">Save Changes</button>
                                    </div>
                                    <div class="col-1">
                                        <button type="button" class="btn btn-secondary">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="table-responsive">
                                <h3 class="text-left mb-3">Loan History</h3>
                                <table id="check_out-table" class="table table-bordered" style="margin-top: 10px">
                                    <thead>
                                        <tr>
                                            <th>Copy ID</th>
                                            <th>Book Title</th>
                                            <th>Author(s)</th>
                                            <th>Date Checked Out</th>
                                            <th>Due Date</th>
                                            <th>Date Checked In</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>114165</td>
                                            <td>Percy Jackson and the Olympians</td>
                                            <td>Steve Roland</td>
                                            <td>11/1/2023</td>
                                            <td>12/1/2023</td>
                                            <td>N/A</td>
                                            <td><span class="badge badge-warning">Borrowed</span></td>
                                        </tr>
                                        <tr>
                                            <td>114165</td>
                                            <td>Percy Jackson and the Olympians</td>
                                            <td>Steve Roland</td>
                                            <td>10/2023</td>
                                            <td>11/1/2023</td>
                                            <td>N/A</td>
                                            <td><span class="badge badge-danger">Overdue</span></td>
                                        </tr>
                                        <tr>
                                            <td>114165</td>
                                            <td>Percy Jackson and the Olympians</td>
                                            <td>Steve Roland</td>
                                            <td>9/1/2023</td>
                                            <td>10/1/2023</td>
                                            <td>10/1/2023</td>
                                            <td><span class="badge badge-success">Returned</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="export-options" style="margin-top: 20px">
                                <p>Export as: </p>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            var table = $('#check_out-table').DataTable({
                "dom": 'frtip',
                "buttons": [
                    'excel',
                    'pdf',
                    'print'
                ],
                "paging": false,
                "info": false,
            });

            var buttons = new $.fn.dataTable.Buttons(table, {
                buttons: [
                    'excel',
                    'pdf',
                    'print'
                ]
            }).container().appendTo($('.export-options'));
        });

    </script>


</body>

</html>