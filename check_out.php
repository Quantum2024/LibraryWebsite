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
                                <button type="button" class="btn-close" data-dismiss="modal"
                                    aria-label="Close"></button>
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

                                            <select class="form-control" id="loaned_condition">
                                                <option value="new">New</option>
                                                <option value="worn">Good</option>
                                                <option value="damaged">Damaged</option>
                                            </select>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="member_id" class="form-label"
                                                style="display: block; width: 100%">Select Member</label>
                                            <select class="form-control member_id_select" id="member_id"
                                                name="member_id" style="width: 100%">

                                            </select>
                                        </div>
                                        <div class="row">
                                            <label for="due_date" class="form-label">Due Date</label>
                                            <input type="date" class="form-control" id="selectedDate"
                                                name="selectedDate"
                                                value="<?php echo date('Y-m-d', strtotime('+2 weeks')) ?>">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Complete Check Out</button>
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
                                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
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
                                        <tbody>
                                            <?php
                                            include 'db_connection.php';
                                            // Step 2: Query the database for book information
                                            $query = "SELECT c.copy_id, b.book_isbn, c.book_condition, b.book_title
                                                            FROM `copy` AS c
                                                            JOIN book AS b ON b.book_isbn = c.book_isbn;";
                                            $copy_result = $mysqli->query($query);
                                            while ($row = $copy_result->fetch_assoc()) {
                                                //check to see if book is checked out already
                                                $query = "SELECT *
                                                            FROM `loan_log` AS l
                                                            WHERE l.date_checked_in IS NULL AND l.copy_id=" . $row["copy_id"] . ";";
                                                $copies_checked_out = $mysqli->query($query);
                                                //if the query returns any values, the copy is checked out, so it should be skipped
                                                if ($copies_checked_out->num_rows > 0) {
                                                    continue;
                                                }
                                                echo "<tr>";
                                                echo "<td><a href=edit_copy.php?copy_id=" . $row['copy_id'] . ">" . $row['copy_id'] . "</td>";
                                                echo "<td><a href=edit_book.php?book_isbn=" . $row['book_isbn'] . ">" . $row['book_title'] . "</td>";

                                                //query the wrote table for authors
                                                $query = "SELECT a.author_first_name, a.author_last_name, a.author_id
                                                    FROM author AS a
                                                    JOIN wrote AS w ON a.author_id= w.author_id
                                                    JOIN book AS b ON b.book_isbn = w.book_isbn
                                                    WHERE b.book_isbn=" . $row['book_isbn'] . ";";
                                                $author_result = $mysqli->query($query);
                                                if (mysqli_num_rows($author_result) == 0) {
                                                    $authors = "No Authors Found";
                                                } else {
                                                    $authors = "";
                                                    while ($rowA = $author_result->fetch_assoc()) {
                                                        $authors .= $authors . "<a href=edit_author.php?author_id=" . $rowA['author_id'] . ">" . $rowA["author_first_name"] . " " . $rowA["author_last_name"] . "<br>";
                                                    }
                                                }
                                                echo '<td>' . $authors . '</td>';
                                                echo '<td><button type="button" class="btn btn-danger btn-sm" 
                                                    data-toggle="modal" copy_id="' . $row["copy_id"] . '"
                                                    loaned_condition="' . $row["book_condition"] . '" data-target="#checkOutModal">Check
                                                    Out</button></td>';
                                                echo "</tr>";
                                            }
                                            $mysqli->close();
                                            ?>
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

            // Initialize Bootstrap modal
            var checkOutModal = new bootstrap.Modal(document.getElementById('checkOutModal'));

            // Handle modal shown event
            checkOutModal._element.addEventListener('shown.bs.modal', function () {
                document.getElementById('loan_log_id').value = 'INSERT LOAN_LOG_ID';
                document.getElementById('loaned_condition').value = 'INSERT LOANED_CONDITION';
                document.getElementById('copy_id').value = 'INSERT COPY_ID';
            });
        });


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

    </script>
    <style>
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