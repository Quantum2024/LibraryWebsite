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
                <div class="modal fade" id="checkOutModal" tabindex="-1" aria-labelledby="checkOutModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="checkOutModalLabel">Check Out Book</h5>
                                <a href="#" data-bs-dismiss="modal">
                                    <i class="fas fa-x" style="outline: none"></i>
                                </a>
                            </div>
                            <div class="modal-body">
                                <!-- Your form field here -->
                                <form id="modalForm" action="check_out_processor.php" method="post">
                                    <div class="mb-3">
                                        <div class="row mb-3">
                                            <label for="copy_id" class="form-label">Copy Number</label>
                                            <input type="text" id="copy_id" name="copy_id" class="form-control"
                                                readonly>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="loaned_condition" class="form-label">Loaned Condition</label>

                                            <select class="form-control" id="loaned_condition" name="loaned_condition">
                                                <option value="New">New</option>
                                                <option value="Good">Good</option>
                                                <option value="Damaged">Damaged</option>
                                            </select>
                                        </div>
                                        <div class="mb-3"
                                            style="padding: 0px; width: 100%; display: flex; flex-wrap: wrap; ">
                                            <label for="member_id" class="form-label" style="width: 100%">Select
                                                Member</label>
                                            <select class="form-control member_id_select" id="member_id"
                                                name="member_id" style="width: 100%">

                                            </select>
                                        </div>
                                        <div class="row">
                                            <label for="due_date" class="form-label">Due Date</label>
                                            <input type="date" class="form-control" id="due_date" name="due_date"
                                                value="<?php echo date('Y-m-d', strtotime('+2 weeks')) ?>">
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <div class="row" id="overdue_warning" hidden>
                                    <p class="color-danger">This Member has an overdue book. They must return it before
                                        checking out a new book.</p>
                                </div>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" id="checkout_button" class="btn btn-primary">Complete Check
                                    Out</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="row mt-3">
                        <div class="col-8">
                            <h1>Check-Out Book</h2>
                        </div>
                        <!-- /# column -->
                        <div class="col-lg-4">
                            <div class="page-header">
                                <div class="page-title">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                        <li class="breadcrumb-item active">Check-Out Book</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /# row -->
                    <section id="main-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table id="check_out-table" class="table table-bordered table-hover"
                                        style="margin-top: 10px">
                                        <thead>
                                            <tr>
                                                <th>Copy ID</th>
                                                <th>Book Title</th>
                                                <th>Author(s)</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="check_out_table_body">

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
                            <p>2023 © Fortuna</p>
                        </div>
                    </div>
                </div>
                </section>
            </div>
        </div>
    </div>

    <!-- jquery vendor -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="js/lib/jquery.nanoscroller.min.js"></script>
    <!-- nano scroller -->
    <script src="js/lib/menubar/sidebar.js"></script>
    <script src="js/lib/preloader/pace.min.js"></script>
    <!-- sidebar -->
    <script src="js/lib/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <!-- sweet alert 2-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- scripit init-->
    <script src="js/lib/data-table/datatables.min.js"></script>
    <script src="js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="js/lib/data-table/buttons.flash.min.js"></script>
    <script src="js/lib/data-table/vfs_fonts.js"></script>
    <script src="js/lib/data-table/buttons.html5.min.js"></script>
    <script src="js/lib/data-table/buttons.print.min.js"></script>
    <script src="js/lib/data-table/datatables-init.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="check_out_processing.js"></script>
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


            var members = [
                {
                    id: 0,
                    text: 'Select a Member'
                }<?php
                include 'db_connection.php';
                $query = "SELECT first_name, last_name, member_id
                FROM `member`";
                $member_result = $mysqli->query($query);
                while ($row = $member_result->fetch_assoc()) {
                    echo ",
                {
                    id: " . $row["member_id"] . ",
                    text: '" . $row["first_name"] . " " . $row["last_name"] . "'
                }";
                }
                $mysqli->close();
                ?>

            ];
            $('.member_id_select').select2({
                placeholder: "Select a Member",
                dropdownParent: $('#checkOutModal'),
                data: members

            })

            $('#checkOutModal').on('show.bs.modal', function (e) {
                // get information to update quickly to modal view as loading begins
                var opener = e.relatedTarget;//this holds the element who called the modal

                //we get details from attributes
                var copy_id = $(opener).attr('copy_id');
                var loaned_condition = $(opener).attr('loaned_condition');

                //set what we got to our form
                $('#modalForm').find('[name="copy_id"]').val(copy_id);
                $('#modalForm').find('[name="loaned_condition"]').val(loaned_condition);

            });

            $("#checkOutModal").on("hidden.bs.modal", function () {
                $('body').css('padding-right', 0);
            });

            //check to see if a member has an overdue book, if they do, disable check_out
            $('#member_id').on('change', function () {
                var member = $('#member_id').val();
                //checking eligibility
                fetch('get_overdue.php?member_id=' + member)
                    .then(response => response.json())
                    .then(data => {
                        // Access the variable value from the response
                        const overdue = data.overdue;

                        if (overdue) {
                            // Show SweetAlert for overdue books
                            Swal.fire({
                                icon: 'warning',
                                title: 'Overdue Books',
                                text: 'This member has an overdue book. Member must return it before borrowing another book.',
                                confirmButtonText: 'OK',
                            });

                            // Disable submit button
                            document.getElementById("checkout_button").disabled = true;

                        } else {
                            // Enable submit button
                            document.getElementById("checkout_button").disabled = false;
                            document.getElementById("overdue_warning").setAttribute("hidden", true);
                        }
                    })
                    .catch(error => {
                        console.error('Error: ' + error);

                        // Show SweetAlert for error
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An error occurred while checking for overdue books.',
                            confirmButtonText: 'OK',
                        });
                    });

            });

        });
    </script>
    <style>
        .select2 {
            width: 100% !important;
        }

        .select2-selection__rendered {
            line-height: 42px !important;
        }

        .select2-container .select2-selection--single {
            height: 42px !important;
        }

        .select2-selection__arrow {
            height: 42px !important;
        }

        .select2-container--default .select2-selection--single {
            border: 1px solid #ced4da;
            border-radius: 4px;
            height: 34px;
            width: 100%;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-clip: padding-box;
            background-color: #fff;
            background-image: none;
            border-radius: 0;
            border-color: #e7e7e7;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }
    </style>

</body>

</html>