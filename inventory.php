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
    <link href="css/lib/calendar2/pignose.calendar.min.css" rel="stylesheet">
    <link href="css/lib/chartist/chartist.min.css" rel="stylesheet">
    <link href="css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="css/lib/themify-icons.css" rel="stylesheet">
    <link href="css/lib/owl.carousel.min.css" rel="stylesheet" />
    <link href="css/lib/owl.theme.default.min.css" rel="stylesheet" />
    <link href="css/lib/weather-icons.css" rel="stylesheet" />
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
                <div class="card">

                    <div class="row mt-3">
                        <div class="col-lg-8">
                            <h1>Inventory</h2>
                        </div>
                        <!-- /# column -->
                        <div class="col-lg-4">
                            <div class="page-header">
                                <div class="page-title">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                        <li class="breadcrumb-item active">Inventory</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->


                    <!-- /# row -->
                    <section id="main-content">
                        <div class="row">
                            <div class="col">
                            <a href="create_book.php"><button type="button" class="btn btn-sm btn-primary float-right">Create New
                                    Book</button></a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="table-responsive">

                                    <table id="inventory-table" class="table table-striped table-bordered table-hover"
                                        style="margin-top: 10px">
                                        <thead>
                                            <tr>
                                                <th>ISBN</th>
                                                <th>Book Title</th>
                                                <th>Author(s)</th>
                                                <th>Genre</th>
                                                <th style="width: 10%">Stock Quantity</th>
                                                <th style="width: 15.5%">Number of Copies Available</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include 'db_connection.php';
                                            // Step 2: Query the database for book information
                                            $query = "SELECT b.book_isbn, b.book_title, g.genre_name
                                                        FROM book AS b
                                                        JOIN genre AS g ON b.genre_id = g.genre_id;";
                                            $book_result = $mysqli->query($query);
                                            while ($row = $book_result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td><a href=edit_book.php?book_isbn=" . $row['book_isbn'] . ">" . $row['book_isbn'] . "<i class='fa-solid fa-pencil' style='margin-left: 5%'></i></a></td>";
                                                echo "<td>" . $row['book_title'] . "</td>";

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
                                                echo "<td>" . $row['genre_name'] . "</td>";
                                                //get stock quantity
                                                $query = "SELECT COUNT(*) FROM `copy` WHERE book_isbn=" . $row['book_isbn'];
                                                $stock_result = $mysqli->query($query);
                                                if ($stock_result) {
                                                    $row_count = $stock_result->fetch_row();
                                                    $count = $row_count[0];
                                                    echo '<td>'. $count . '</td>';
                                                } else {
                                                    echo "Error executing the query: " . $mysqli->error;
                                                }   
                                                //get number of books available to check out
                                                $query = "SELECT COUNT(*) 
                                                          FROM `loan_log` AS `l`
                                                          LEFT JOIN `copy` AS `c` ON l.copy_id = c.copy_id
                                                          LEFT JOIN `book` AS `b` ON b.book_isbn = c.book_isbn
                                                          WHERE c.book_isbn=" . $row['book_isbn'] . " AND l.date_checked_in IS NULL";
                                                $checked_out_result = $mysqli->query($query);
                                                if ($checked_out_result) {
                                                    $row_count2 = $checked_out_result->fetch_row();
                                                    $num_of_copies_checked_out = $row_count2[0];
                                                    echo '<td>'. $count - $num_of_copies_checked_out . '</td>';
                                                } else {
                                                    echo "Error executing the query: " . $mysqli->error;
                                                }                                         
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
                            <p>2023 © Fortuna</p>
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
            var table = $('#inventory-table').DataTable({
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