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
                            <h1>Book Information</h2>
                        </div>
                        <!-- /# column -->
                        <div class="col-lg-6">
                            <div class="page-header">
                                <div class="page-title">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="inventory.php">Inventory</a></li>
                                        <li class="breadcrumb-item active">Create Book</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    <section id="main-content">
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <form method="post" action="insert_data.php">

                                    <div class="mb-3">
                                        <div class="row mb-3">


                                            <div class="row mb-3">
                                                <div class="col">
                                                    <label for="book_isbn" class="form-label">Book ISBN</label>
                                                    <input type="number" id="book_isbn" name="book_isbn"
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="book_title" class="form-label">Title</label>
                                            <input type="text" id="book_title" name="book_title" class="form-control">
                                        </div>
                                        <div class="col">
                                            <label for="author_first_name" class="form-label">Author First
                                                Name</label>
                                            <input type="text" id="author_first_name" name="author_first_name"
                                                class="form-control">
                                        </div>
                                        <div class="col">
                                            <label for="author_last_name" class="form-label">Author Last
                                                Name</label>
                                            <input type="text" id="author_last_name" name="author_last_name"
                                                class="form-control">
                                        </div>

                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="genre_name" class="form-label">Genre</label>
                                            <select id="genre_name" name="genre_name" class="form-control">
                                                <?php include 'db_connection.php';
                                                // Fetch genres from the database
                                                $genreQuery = "SELECT genre_name FROM genre";
                                                $genreResult = mysqli_query($mysqli, $genreQuery);

                                                if ($genreResult) {
                                                    while ($row = mysqli_fetch_assoc($genreResult)) {
                                                        echo "<option value='" . $row['genre_name'] . "'>" . $row['genre_name'] . "</option>";
                                                    }
                                                } else {
                                                    echo "Error: " . mysqli_error($mysqli);
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="language" class="form-label">Language</label>
                                            <input type="text" id="language" name="language" class="form-control">
                                        </div>
                                        <div class="col">
                                            <label for="publisher_name" class="form-label">Publisher</label>
                                            <select id="publisher_name" name="publisher_name" class="form-control">
                                                <?php
                                                // Fetch publishers from the database
                                                $publisherQuery = "SELECT publisher_name FROM publisher";
                                                $publisherResult = mysqli_query($mysqli, $publisherQuery);

                                                if ($publisherResult) {
                                                    while ($row = mysqli_fetch_assoc($publisherResult)) {
                                                        echo "<option value='" . $row['publisher_name'] . "'>" . $row['publisher_name'] . "</option>";
                                                    }
                                                } else {
                                                    echo "Error: " . mysqli_error($mysqli);
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-4">
                                            <label for="edition" class="form-label">Edition</label>
                                            <input type="number" id="edition" name="edition" class="form-control">
                                        </div>
                                        <div class="col-4">
                                            <label for="num_of_pages" class="form-label">Number of
                                                Pages</label>
                                            <input type="number" id="num_of_pages" name="num_of_pages"
                                                class="form-control">
                                        </div>
                                        <div class="col-4">
                                            <label for="stock_quantity" class="form-label">Quantity</label>
                                            <input type="number" id="stock_quantity" name="stock_quantity"
                                                class="form-control">
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-1">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                            <div class="col-1">
                                <button type="button" class="btn btn-secondary">Close</button>
                            </div>
                        </div>
                        </form>

                </div>
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