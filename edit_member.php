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
                                    <?php
                                    include 'db_connection.php';
                                    if (isset($_GET['member_id'])) {
                                        $member_id = $_GET['member_id'];
                                    } else {
                                        die("No Member ID is set.");
                                    }
                                    // Step 2: Query the database for members loan history
                                    $query = "SELECT m.first_name, m.last_name, m.DOB, m.phone_number, m.email_address FROM member AS m  WHERE m.member_id=" . $member_id;
                                    $member_result = $mysqli->query($query);

                                    if ($member_result->num_rows == 0) {
                                        die("Member ID does not exist.");
                                    } else {
                                        while ($row = $member_result->fetch_assoc()) {
                                            $first_name = $row["first_name"];
                                            $last_name = $row["last_name"];
                                            $DOB = $row["DOB"];
                                            $phone_number = $row["phone_number"];
                                            $email_address = $row["email_address"];
                                        }
                                    }

                                    $mysqli->close();
                                    ?>
                                    <div class="mb-3">
                                        <div class="row mb-3">
                                            <div class="col">
                                                <input type="text" id="member_id" name="member_id" class="form-control"
                                                    value="<?php echo $member_id ?>" hidden>

                                                <label for="first_name" class="form-label">First Name</label>
                                                <input type="text" id="first_name" name="first_name"
                                                    class="form-control" value="<?php echo $first_name ?>">
                                            </div>
                                            <div class="col">
                                                <label for="last_name" class="form-label">Last Name</label>
                                                <input type="text" id="last_name" name="last_name" class="form-control"
                                                    value="<?php echo $last_name ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <label for="DOB" class="form-label">Date of Birth</label>
                                                <input type="date" id="DOB" name="DOB" class="form-control"
                                                    value="<?php echo $DOB ?>">
                                            </div>
                                            <div class="col">
                                                <label for="phone_number" class="form-label">Phone Number</label>
                                                <input type="text" id="phone_number" name="phone_number"
                                                    class="form-control" value="<?php echo $phone_number ?>">
                                            </div>
                                            <div class="col">
                                                <label for="email_address" class="form-label">Email Address</label>
                                                <input type="email" id="email_address" name="email_address"
                                                    class="form-control" value="<?php echo $email_address ?>">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="row" id="processingMessage0" style="display: none;">
                                    <p class="color-warning">Processing Changes .........</p>
                                </div>
                                <div class="row" id="successMessage0" style="display: none;">
                                    <p class="color-success">Changes were succesfully submitted</p>
                                </div>
                                <div class="row" id="failureMessage0" style="display: none;">
                                    <p class="color-danger">Changes failed to save</p>
                                </div>
                                <div class="row">
                                    <div class="col-1">
                                        <button type="button" id="submit-form" class="btn btn-primary">Save
                                            Changes</button>
                                    </div>
                                    <div class="col-1">
                                        <a href="inventory.php"><button type="button"
                                                class="btn btn-secondary">Cancel</button><a href="inventory.php">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="card">
                                <div class="table-responsive">
                                    <h3 class="text-left mb-3">Loan History</h3>
                                    <table id="loan-table" class="table table-bordered table-hover"
                                        style="margin-top: 10px">
                                        <thead>
                                            <tr>
                                                <th>Transaction ID</th>
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
                                            <?php
                                            include 'db_connection.php';
                                            if (isset($_GET['member_id'])) {
                                                $member_id = $_GET['member_id'];
                                            } else {
                                                die("No Member ID is set.");
                                            }
                                            // Step 2: Query the database for members loan history
                                            $query = "SELECT c.copy_id, b.book_isbn, b.book_title, l.date_checked_out, l.due_date, l.date_checked_in, l.loan_log_id
                                                            FROM `loan_log` AS l
                                                            LEFT JOIN `copy` AS c ON l.copy_id=c.copy_id
                                                            LEFT JOIN `book` AS b ON b.book_isbn=c.book_isbn                                                            
                                                            LEFT JOIN member AS m ON m.member_id=l.member_id WHERE l.member_id=" . $member_id;
                                            $loan_result = $mysqli->query($query);
                                            if ($loan_result->num_rows == 0) {
                                                echo "<tr><td >No Loan History</td>";
                                                echo "<td ></td>";
                                                echo "<td ></td>";
                                                echo "<td ></td>";
                                                echo "<td ></td>";
                                                echo "<td ></td>";
                                                echo "<td ></td>";
                                                echo "<td ></td></tr>";
                                            } else {
                                                while ($row = $loan_result->fetch_assoc()) {
                                                    //check to see if book is checked out already
                                            
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
                                                    echo '<td>' . $authors . '</td>';

                                                    $due_date = date("m/d/Y", strtotime(($row['due_date'])));
                                                    $date_checked_out = date("m/d/Y", strtotime(($row['date_checked_out'])));

                                                    //check to see if the book has been checked in, and if it hasnt checked to see if its overdue
                                                    if ($row['date_checked_in'] === null) {
                                                        $date_checked_in = "N/A";
                                                        $current_date = date("m/d/Y");
                                                        if (strtotime($due_date) >= strtotime($current_date)) {
                                                            $badge = '<td><span class="badge badge-warning">Borrowed</span></td>';
                                                        } else {
                                                            $badge = '<td><span class="badge badge-danger">Overdue</span></td>';
                                                        }
                                                    } else {
                                                        $date_checked_in = date("m/d/Y", strtotime(($row['date_checked_in'])));
                                                        $badge = '<td><span class="badge badge-success">Returned</span></td>';
                                                    }
                                                    echo '<td>' . $date_checked_out . '</td>';
                                                    echo '<td>' . $due_date . '</td>';
                                                    echo '<td>' . $date_checked_in . '</td>';
                                                    echo $badge;

                                                    echo "</tr>";
                                                }
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
            $("#submit-form").click(function () {
                var first_name = $("#first_name").val();
                var last_name = $("#last_name").val();
                var dob = $("#DOB").val();
                var phone_number = $("#phone_number").val();
                var email_address = $("#email_address").val();
                var member_id = $("#member_id").val();

                // Show processing message
                $("#processingMessage0").show();
                $("#successMessage0").hide();
                $("#failureMessage0").hide();
                $.ajax({
                    type: "POST",
                    url: "edit_member_processor.php",
                    data: {
                        first_name: first_name,
                        last_name: last_name,
                        DOB: dob,
                        phone_number: phone_number,
                        email_address: email_address,
                        member_id: member_id
                    },
                    success: function (data) {
                        //hide processing messag
                        console.log(data);
                        $("#processingMessage0").hide();
                        $("#successMessage0").show();
                    },
                    error: function (xhr, error) {
                        console.log("Error: " + error.message);
                        $("#processingMessage0").hide();
                        $("#failureMessage0").show();
                    }
                });
            });
            var table = $('#loan-table').DataTable({
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