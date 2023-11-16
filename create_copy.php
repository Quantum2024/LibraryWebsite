<!DOCTYPE html>
<html lang="en">
<?php include 'db_connection.php';
if ($_GET["book_isbn"]) {
    $book_isbn = $_GET["book_isbn"];
} else {
    die("ISBN is not set");
} ?>

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
                            <h1>Copy Information</h1>
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
                                <form method="post" id="newCopyForm">
                                    <div class="mb-3">
                                        <div class="row mb-3">
                                            <div class="col-4">
                                                <label for="book_isbn" class="form-label"></label>
                                                <input type="number" id="book_isbn" name="book_isbn" class="form-control" readonly value="<?php echo $book_isbn ?>" hidden>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="row mb-3">
                                                <div class="col-4" id="supplier_col">
                                                    <label for="supplier_name" class="form-label">Supplier</label>
                                                    <input type="text" id="supplier_name" name="supplier_name" class="form-control">
                                                </div>
                                                <div class="col-4">
                                                    <label for="published_date" class="form-label">Published Date</label>
                                                    <input type="date" id="published_date" name="published_date" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-4">
                                                <label for="unit_price" class="form-label">Unit Price</label>
                                                <input type="number" id="unit_price" name="unit_price" step="0.01" class="form-control">
                                            </div>
                                            <div class="col-4">
                                                <label for="book_condition" class="form-label">Book Condition</label>
                                                <select id="book_condition" name="book_condition" class="form-control">
                                                    <option value="New">New</option>
                                                    <option value="Good">Good</option>
                                                    <option value="Damaged">Damaged</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-">
                                            <button type="submit" id="copySubmission" class="btn btn-primary">Submit New Copy</button>
                                        </div>
                                        <div class="col-">
                                            <a href="edit_book.php"><button type="button" class="btn btn-secondary">Close</button></a>
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
                <p>2023 © Caribbean Public Library <a href="#"></a></p>

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
    <script src="create_copy_processing.js"></script>


</body>

</html>