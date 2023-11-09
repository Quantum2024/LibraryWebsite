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
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <?php include 'sidebar.php';
    include 'header.php'; ?>




    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="modal fade" id="checkInModal" tabindex="-1" aria-labelledby="checkInModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="checkInModalLabel">Check In Book</h5>
                                <a href="#" data-dismiss="modal">
                                    <i class="fas fa-x" style="outline: none"></i>
                                </a>
                            </div>
                            <div class="modal-body">
                                <!-- Your form field here -->
                                <form id="modalForm" action="check_in_processor.php" method="post">
                                    <div class="mb-3">
                                        <div class="row mb-3">
                                            <label for="copy_id" class="form-label">Copy Number</label>
                                            <input type="text" id="copy_id" name="copy_id" class="form-control"
                                                readonly>
                                        </div>
                                        <input type="hidden" id="loan_log_id" name="loan_log_id">
                                        <div class="row mb-3">
                                            <label for="loaned_condition" class="form-label">Loaned Condition</label>
                                            <input type="text" name="loaned_condition" class="form-control" readonly>
                                        </div>
                                        <div class="row">
                                            <label for="condition_returned" class="form-label">Condition
                                                Returned</label>
                                            <select class="form-control" id="condition_returned"
                                                name="condition_returned">
                                                <option value="New">New</option>
                                                <option value="Good">Good</option>
                                                <option value="Damaged">Damaged</option>
                                            </select>
                                        </div>
                                    </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Complete Check In</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="row mt-3">
                        <div class="col-8">
                            <h1>Check-In Book</h2>
                        </div>
                        <!-- /# column -->
                        <div class="col-lg-4">
                            <div class="page-header">
                                <div class="page-title">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                        <li class="breadcrumb-item active">Check-In Book</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->



                    <!-- /# row -->
                    <section id="main-content">
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="table-responsive">

                                    <table id="check_in-table" class="table table-bordered table-hover"
                                        style="margin-top: 10px">
                                        <thead>
                                            <tr>
                                                <th>Loan ID</th>
                                                <th>Copy ID</th>
                                                <th>Book Title</th>
                                                <th>Author(s)</th>
                                                <th>Member</th>
                                                <th>Due Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            include 'db_connection.php';
                                            // Step 2: Query the database for book information
                                            $query = "SELECT c.copy_id, b.book_isbn, c.book_condition, b.book_title, m.first_name, m.last_name, l.due_date, l.loan_log_id
                                                            FROM loan_log AS l
                                                            JOIN `copy` AS c ON l.copy_id = c.copy_id
                                                            JOIN book AS b ON b.book_isbn = c.book_isbn                                                           
                                                            JOIN member AS m ON m.member_id = l.member_id 
                                                            WHERE l.date_checked_in IS NULL;";
                                            $loaned_result = $mysqli->query($query);
                                            while ($row = $loaned_result->fetch_assoc()) {
                                                $i = 0;
                                                echo "<tr>";
                                                echo "<td><a href=edit_loan_log.php?loan_log_id=" . $row['loan_log_id'] . ">" . $row['loan_log_id'] . "</td>";
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
                                                echo "<td>" . $authors . "</td>";
                                                echo "<td>" . $row['first_name'] . " " . $row["last_name"] . "</td>";
                                                echo "<td>" . date("m/d/Y", strtotime(($row['due_date']))) . "</td>";
                                                echo '<td><button type="button" class="btn btn-success btn-sm" id="check_in' . $i . '"
                                                    data-toggle="modal" loan_log_id="' . $row["loan_log_id"] . '" copy_id="' . $row["copy_id"] . '"
                                                    loaned_condition="' . $row["book_condition"] . '" data-target="#checkInModal">Check
                                                    In</button></td>';
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
    <script>
        $(document).ready(function () {
            var table = $('#check_in-table').DataTable({
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

            $('#checkInModal').on('show.bs.modal', function (e) {
                // get information to update quickly to modal view as loading begins
                var opener = e.relatedTarget;//this holds the element who called the modal

                //we get details from attributes
                var loan_log_id = $(opener).attr('loan_log_id');
                var copy_id = $(opener).attr('copy_id');
                var loaned_condition = $(opener).attr('loaned_condition');

                //set what we got to our form
                $('#modalForm').find('[name="loan_log_id"]').val(loan_log_id);
                $('#modalForm').find('[name="copy_id"]').val(copy_id);
                $('#modalForm').find('[name="loaned_condition"]').val(loaned_condition);
                $('#modalForm').find('[id="condition_returned"]').val(loaned_condition);

            });

            $("#checkInModal").on("hidden.bs.modal", function () {
                $('body').css('padding-right', 0);
            });
        });


    </script>
</body>

</html>