<!DOCTYPE html>
<html lang="en">
<?php include 'db_connection.php'; 
if($_GET["book_isbn"]){
    $book_isbn=$_GET["book_isbn"];
}else{
    die("ISBN is not set");
}?>

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
                                <form method="post" action="insert_data_new_copy.php">

                                    <div class="mb-3">
                                        <div class="row mb-3">
                                            <div class="col-4">
                                                <label for="book_isbn" class="form-label">Book ISBN</label>
                                                <input type="number" id="book_isbn" name="book_isbn" class="form-control" readonly value="<?php echo $book_isbn ?>">

                                            </div>

                                        </div>
                                        <div class="mb-3">
                                            <div class="row mb-3">



                                                <div class="col-4" id="supplier_col">
                                                    <label for="supplier_name" class="form-label">Supplier</label>

                                                    <!-- Modal Start -->
                                                    <button type="button" class="btn btn-sm btn-primary float-right" data-bs-toggle="modal" data-bs-target="#newSupplier" style="padding: 0px 5px;">New
                                                        Supplier</button>
                                                    <div class="modal fade" id="newSupplier" tabindex="-1" aria-labelledby="newSupplierLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="newSupplierLabel">New
                                                                        Supplier</h5>
                                                                    <a href="#" data-bs-dismiss="modal">
                                                                        <i class="fas fa-x" style="outline: none"></i>
                                                                    </a>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <!-- Your form field here -->
                                                                    <form id="newSupplierForm" method="post">
                                                                        <div class="mb-3">
                                                                            <label for="supplier_name" class="form-label">Supplier
                                                                                Name</label>
                                                                            <input type="text" id="new_supplier_name" name="supplier_name" class="form-control">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="supplier_country" class="form-label">Supplier
                                                                                Country</label>
                                                                            <input type="text" id="supplier_country" name="supplier_country" class="form-control">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="supplier_email_address" class="form-label">Email Address</label>
                                                                            <input type="supplier_email_address" id="supplier_email_address" name="supplier_email_address" class="form-control">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="supplier_phone_number" class="form-label">Phone Number</label>
                                                                            <input type="number" id="supplier_phone_number" name="supplier_phone_number" class="form-control">
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <div id="processingMessage2" style="display: none;">
                                                                        Processing...</div>
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="button" id="submitSupplier" class="btn btn-primary">Save</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Modal End -->
                                                    <div id="supplierSuccessMessage"></div>
                                                    <select id="supplier_name" name="supplier_name" class="form-control">

                                                    </select>



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
                                                <input type="number" id="unit_price" name="unit_price" class="form-control">
                                            </div>
                                            <div class="col-4">
                                                <label for="book_condition" class="form-label">Book Condition</label>
                                                <select id="book_condition" name="book_condition" class="form-control">
                                                    <option value="new">New</option>
                                                    <option value="good">Good</option>
                                                    <option value="damage">Damaged</option>
                                                </select>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-1">
                                            <button type="submit" id="bookSubmission" class="btn btn-primary">Save Changes</button>
                                        </div>
                                        <div class="col-1">
                                            <a href="inventory.php"><button type="button" class="btn btn-secondary">Close</button></a>
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
    <script src="sweetalert2/dist/sweetalert2.min.js"></script>

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
    <script src="create_copy_supplier.js"></script>


    <!-- Success Modal  -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                    <a href="#" data-dismiss="modal">
                        <i class="fas fa-x" style="outline: none"></i>
                    </a>
                </div>
                <div class="modal-body">
                    <span id="successMessage"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
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