<!DOCTYPE html>
<html lang="en">
<?php include 'db_connection.php'; ?>

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
                            <h1>Book Information</h1>
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
                        <!-- New Author Modal-->
                        <div class="modal fade" id="NewAuthor" tabindex="-1" aria-labelledby="NewAuthorLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="NewAuthorLabel">New
                                            Author</h5>
                                        <a href="#" data-bs-dismiss="modal">
                                            <i class="fas fa-x" style="outline: none"></i>
                                        </a>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Your form field here -->
                                        <form id="newAuthorForm">
                                            <div class="mb-3">
                                                <label for="author_first_name" class="form-label">Author First
                                                    Name</label>
                                                <input type="text" id="author_first_name" name="author_first_name"
                                                    class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label for="author_last_name" class="form-label">Author Last
                                                    Name</label>
                                                <input type="text" id="author_last_name" name="author_last_name"
                                                    class="form-control">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <div id="processingMessage" style="display: none;">
                                            Processing...</div>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" id="submitAuthor" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- New Genre Modal-->
                        <div class="modal fade" id="NewGenre" tabindex="-1" aria-labelledby="NewGenreLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="NewGenreLabel">Add New
                                            Genre</h5>
                                        <a href="#" data-bs-dismiss="modal">
                                            <i class="fas fa-x" style="outline: none"></i>
                                        </a>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Your form field here -->
                                        <form id="modalForm">

                                            <div class="mb-3">
                                                <label for="genre_name" class="form-label">Genre
                                                    Name</label>
                                                <input type="text" id="genre_name" name="genre_name"
                                                    class="form-control">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <div id="processingMessage3" style="display: none;">
                                            Processing...</div>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" id="submitGenre" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- New Publisher Modal-->
                        <div class="modal fade" id="NewPublisher" tabindex="-1" aria-labelledby="NewPublisherLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="NewPublisherLabel">New
                                            Publisher</h5>
                                        <a href="#" data-bs-dismiss="modal">
                                            <i class="fas fa-x" style="outline: none"></i>
                                        </a>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Your form field here -->
                                        <form id="newPublisherForm" method="post">
                                            <div class="mb-3">
                                                <label for="publisher_name" class="form-label">Publisher
                                                    Name</label>
                                                <input type="text" id="new_publisher_name" name="publisher_name"
                                                    class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label for="publisher_country" class="form-label">Publisher
                                                    Country</label>
                                                <input type="text" id="publisher_country" name="publisher_country"
                                                    class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label for="email_address" class="form-label">Email Address</label>
                                                <input type="email" id="email_address" name="email_address"
                                                    class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label for="phone_number" class="form-label">Phone Number</label>
                                                <input type="text" id="phone_number" name="phone_number"
                                                    class="form-control">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <div id="processingMessage2" style="display: none;">
                                            Processing...</div>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" id="submitPublisher" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <form method="post" id="newBookForm">

                                    <div class="mb-3">
                                        <div class="row mb-3">
                                            <div class="col-4">
                                                <label for="book_isbn" class="form-label">Book ISBN</label>
                                                <input type="number" id="book_isbn" name="book_isbn"
                                                    class="form-control" min="1000000000" max="9999999999999">
                                            </div>
                                            <div class="col-4">
                                                <label for="book_title" class="form-label">Title</label>
                                                <input type="text" id="book_title" name="book_title"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="row mb-3">

                                                <div class="col-4">
                                                    <label for="edition" class="form-label">Edition</label>
                                                    <input type="number" id="edition" name="edition"
                                                        class="form-control">
                                                </div>
                                                <div class="col" id="author_col">
                                                    <label for="author_first_name" class="form-label">Author
                                                        Name</label>

                                                    <!-- Modal Start-->
                                                    <button type="button" class="btn btn-sm btn-primary float-right"
                                                        data-bs-toggle="modal" data-bs-target="#NewAuthor"
                                                        style="padding: 0px 5px;">New
                                                        Author</button>




                                                    <!-- Modal End-->

                                                    <div id="authorSuccessMessage"></div>
                                                    <select id="author_name" name="author_name" class="form-control">
                                                    </select>
                                                </div>

                                                <div class="col" id="publisher_col">
                                                    <label for="publisher_name" class="form-label">Publisher</label>

                                                    <!-- Modal Start -->
                                                    <button type="button" class="btn btn-sm btn-primary float-right"
                                                        data-bs-toggle="modal" data-bs-target="#NewPublisher"
                                                        style="padding: 0px 5px;">New
                                                        Publisher</button>


                                                    <!-- Modal End -->
                                                    <div id="publisherSuccessMessage"></div>
                                                    <select id="publisher_name" name="publisher_name"
                                                        class="form-control">

                                                    </select>
                                                </div>

                                            </div>
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <label for="genre_name_primary" class="form-label">Genre</label>
                                                    <!-- Modal Start-->
                                                    <button type="button" class="btn btn-sm btn-primary float-right"
                                                        data-bs-toggle="modal" data-bs-target="#NewGenre"
                                                        style="padding: 0px 5px;">New
                                                        Genre</button>




                                                    <!-- Modal End-->

                                                    <div id="genreSuccessMessage"></div>

                                                    <select id="genre_name_primary" name="genre_name_primary"
                                                        class="form-control">

                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <label for="language" class="form-label">Language</label>
                                                    <input type="text" id="language" name="language"
                                                        class="form-control">
                                                </div>
                                                <div class="col-4">
                                                    <label for="num_of_pages" class="form-label">Number of
                                                        Pages</label>
                                                    <input type="number" id="num_of_pages" name="num_of_pages"
                                                        class="form-control">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <button type="submit" id="bookSubmission"
                                                    class="btn btn-primary text-nowrap mr-2 float-left">Save
                                                    Changes</button>

                                                <a href="inventory.php"><button type="button"
                                                        class="btn btn-secondary">Close</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>

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
    <script src="create_pub_genre_author.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="validation.js"></script>




    <!-- Success Modal  -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                    <a href="#" data-bs-dismiss="modal">
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

    .error {
        color: red;
    }
</style>