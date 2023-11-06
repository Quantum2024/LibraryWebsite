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
                                <form method="post" action="insert_data_new_book.php">

                                    <div class="mb-3">
                                        <div class="row mb-3">
                                            <div class="col-4">
                                                <label for="book_isbn" class="form-label">Book ISBN</label>
                                                <input type="number" id="book_isbn" name="book_isbn"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <label for="book_title" class="form-label">Title</label>
                                                    <input type="text" id="book_title" name="book_title"
                                                        class="form-control">
                                                </div>
                                                <div class="col-4">
                                                    <label for="edition" class="form-label">Edition</label>
                                                    <input type="number" id="edition" name="edition"
                                                        class="form-control">
                                                </div>
                                                <div class="col">
                                                    <label for="author_first_name" class="form-label">Author
                                                        Name</label>
                                                    <!-- Modal Start-->
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#NewAuthor">Open Modal</button>
                                                    <div class="modal fade" id="NewAuthor" tabindex="-1"
                                                        aria-labelledby="NewAuthorLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="NewAuthorLabel">New
                                                                        Author</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <!-- Your form field here -->
                                                                    <form id="modalForm" action="check_in_processor.php"
                                                                        method="post">
                                                                        <div class="mb-3">
                                                                            <label for="author_first_name"
                                                                                class="form-label">Author First
                                                                                Name</label>
                                                                            <input type="text" id="author_first_name"
                                                                                name="author_first_name"
                                                                                class="form-control">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="author_last_name"
                                                                                class="form-label">Author Last
                                                                                Name</label>
                                                                            <input type="text" id="author_last_name"
                                                                                name="author_last_name"
                                                                                class="form-control">
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Save</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Modal End-->
                                                    <select id="author_name" name="author_name" class="form-control">
                                                        <?php
                                                        // Include the database connection
                                                        include 'db_connection.php';

                                                        // SQL query to retrieve author names
                                                        $query = "SELECT CONCAT(author_first_name, ' ', author_last_name) AS author_name FROM author";

                                                        // Perform the query
                                                        $result = $mysqli->query($query);

                                                        // Check for errors
                                                        if (!$result) {
                                                            echo "Error: " . $mysqli->error;
                                                        } else {
                                                            // Fetch author names and create options
                                                            while ($row = $result->fetch_assoc()) {
                                                                $authorName = $row['author_name'];
                                                                echo "<option value='$authorName'>$authorName</option>";
                                                            }
                                                        }


                                                        ?>
                                                    </select>
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
                                                    <input type="text" id="language" name="language"
                                                        class="form-control">
                                                </div>
                                                <div class="col">
                                                    <label for="publisher_name" class="form-label">Publisher</label>
                                                    <select id="publisher_name" name="publisher_name"
                                                        class="form-control">
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
                                                    <label for="num_of_pages" class="form-label">Number of
                                                        Pages</label>
                                                    <input type="number" id="num_of_pages" name="num_of_pages"
                                                        class="form-control">
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
        </section>


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



</body>

</html>