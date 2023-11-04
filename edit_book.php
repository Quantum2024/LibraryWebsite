<!DOCTYPE html>
<html lang="en">
<?php
include 'db_connection.php';
if (isset($_GET['book_isbn'])) {
    $book_isbn = $_GET['book_isbn'];
} else {
    die("No Member ID is set.");
}
// Step 2: Query the database for members loan history
$query = "SELECT b.book_title, b.edition, b.language, g.genre_name, p.publisher_id, p.publisher_name, b.num_of_pages 
                                        FROM book AS b
                                        LEFT JOIN genre AS g ON b.genre_id=g.genre_id
                                        LEFT JOIN publisher AS p ON p.publisher_id = b.publisher_id
                                        WHERE b.book_isbn=" . $book_isbn . ";";
$book_result = $mysqli->query($query);

if ($book_result->num_rows == 0) {
    die("Book ID does not exist.");
} else {
    while ($row = $book_result->fetch_assoc()) {
        $book_title = $row["book_title"];
        $edition = $row["edition"];
        $language = $row["language"];
        $genre = $row["genre_name"];
        $publisher = $row["publisher_name"];
        $num_of_pages = $row["num_of_pages"];
    }
}


?>

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
                            <h1>
                                <?php echo $book_title . " " ?> Information</h2>
                        </div>
                        <!-- /# column -->
                        <div class="col-lg-6">
                            <div class="page-header">
                                <div class="page-title">

                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                        <li class="breadcrumb-item"><a href="Inventory.php">Inventory</a></li>
                                        <li class="breadcrumb-item active">Edit Book</li>
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
                                                <input type="text" id="book_isbn" name="book_isbn" class="form-control"
                                                    value="<?php echo $book_isbn ?>" hidden>

                                                <label for="book_title" class="form-label">Title</label>
                                                <input type="text" id="book_title" name="book_title"
                                                    class="form-control" value="<?php echo $book_title ?>">
                                            </div>
                                            <!--AUTHOR MULTI SELECT FORM ELEMENT WITH CONNECTION TO DATABASE/ARRAY-->
                                            <div class="col">
                                                <label for="edition" class="form-label">Edition</label>
                                                <input type="text" id="edition" name="edition" class="form-control"
                                                    value="<?php echo $edition ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <label for="language" class="form-label">Language</label>
                                                <input type="text" id="language" name="language" class="form-control"
                                                    value="<?php echo $language ?>">
                                            </div>
                                            <!--CREATE GENRE SELECT FIELD-->
                                            <div class="col">
                                                <label for="genre" class="form-label">Genre</label>
                                                <input type="text" id="genre" name="genre" class="form-control"
                                                    value="<?php echo $genre ?>">
                                            </div>
                                            <!--CREATE PUBLISHER SELECT FIELD-->
                                            <div class="col">
                                                <label for="publisher" class="form-label">Publisher</label>
                                                <input type="text" id="publisher" name="publisher" class="form-control"
                                                    value="<?php echo $publisher ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <label for="num_of_pages" class="form-label">Number of Pages</label>
                                                <input type="number" id="num_of_pages" name="num_of_pages"
                                                    class="form-control" value="<?php echo $num_of_pages ?>">
                                            </div>

                                            <div class="col">
                                                <?php //get stock quantity
                                                $query = "SELECT COUNT(*) FROM `copy` WHERE book_isbn=" . $book_isbn;
                                                $stock_result = $mysqli->query($query);
                                                if ($stock_result) {
                                                    $row_count = $stock_result->fetch_row();
                                                    $stock_quantity = $row_count[0];
                                                } else {
                                                    echo "Error executing the query: " . $mysqli->error;
                                                }
                                                $mysqli->close(); ?>
                                                <label for="stock_quantity" class="form-label">Stock Quantity</label>
                                                <input type="number" id="stock_quantity" name="stock_quantity"
                                                    class="form-control" value="<?php echo $stock_quantity ?>" readonly>

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
                                <h3 class="text-left mb-3">Copies</h3>
                                <table id="copies-table" class="table table-bordered table-hover"
                                    style="margin-top: 10px">
                                    <thead>
                                        <tr>
                                            <th>Copy ID</th>
                                            <th>Supplier</th>
                                            <th>Unit Price</th>
                                            <th>Published Date</th>
                                            <th>Book Condition</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include 'db_connection.php';
                                        // Step 2: Query the database for copies of books
                                        $query = "SELECT c.copy_id, c.supplier_name, c.unit_price, c.published_date, c.book_condition, l.due_date, l.date_checked_in
                                                    FROM  `copy` AS c
                                                    LEFT JOIN (
                                                                SELECT copy_id, MAX(date_checked_out) AS recent_date_checked_out
                                                                FROM loan_log GROUP BY copy_id) most_recent ON c.copy_id = most_recent.copy_id
                                                    LEFT JOIN loan_log AS l ON c.copy_id = l.copy_id AND l.date_checked_out = most_recent.recent_date_checked_out
                                                    LEFT JOIN book AS b ON b.book_isbn = c.book_isbn
                                                    WHERE b.book_isbn = " . $book_isbn . ";";
                                        $copy_result = $mysqli->query($query);

                                        if ($copy_result->num_rows == 0) {
                                            echo "<tr><td colspan='6'>No Copies in Inventory</td></tr>";
                                        } else {
                                            while ($row = $copy_result->fetch_assoc()) {
                                                $copy_id = $row["copy_id"];
                                                $supplier_name = $row["supplier_name"];
                                                $unit_price = $row["unit_price"];
                                                $published_date = $row["published_date"];
                                                $book_condition = $row["book_condition"];
                                                $due_date = $row["due_date"];
                                                $date_checked_in = $row["date_checked_in"];
                                                echo "<tr>";
                                                echo "<td>" . $copy_id . "</td>";
                                                echo "<td>" . $supplier_name . "</td>";
                                                echo "<td>" . $unit_price . "</td>";
                                                echo "<td>" . date("m/d/Y", strtotime($published_date)) . "</td>";
                                                echo "<td>" . $book_condition . "</td>";
                                                if ($date_checked_in === null) {
                                                    $current_date = date("m/d/Y");
                                                    if (strtotime($due_date) >= strtotime($current_date)) {
                                                        $badge = '<td><span class="badge badge-warning">Borrowed</span></td>';
                                                    } else {
                                                        $badge = '<td><span class="badge badge-danger">Overdue</span></td>';
                                                    }
                                                } else {
                                                    $badge = '<td><span class="badge badge-success">Returned</span></td>';
                                                }
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
            var table = $('#copies-table').DataTable({
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