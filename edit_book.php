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
$query = "SELECT b.book_title, b.edition, b.language, g.genre_id, p.publisher_id, p.publisher_name, b.num_of_pages, a.author_first_name, a.author_last_name, a.author_id 
                                        FROM book AS b
                                        LEFT JOIN genre AS g ON b.genre_id=g.genre_id
                                        LEFT JOIN publisher AS p ON p.publisher_id = b.publisher_id
                                        RIGHT JOIN wrote AS w on w.book_isbn=b.book_isbn
                                        LEFT JOIN author AS a on a.author_id=w.author_id
                                        WHERE b.book_isbn=" . $book_isbn . ";";
$book_result = $mysqli->query($query);

if ($book_result->num_rows == 0) {
    die("Book ID does not exist.");
} else {
    while ($row = $book_result->fetch_assoc()) {
        $book_title = $row["book_title"];
        $edition = $row["edition"];
        $language = $row["language"];
        $genre_id = $row["genre_id"];
        $publisher_id = $row["publisher_id"];
        $num_of_pages = $row["num_of_pages"];
        $author_id = $row["author_id"];
        $author_first_name = $row["author_first_name"];
        $author_last_name = $row["author_last_name"];
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
                                            <div class="col" id="author_col">
                                                <label for="author_id" class="form-label">Author
                                                </label>

                                                <!-- Modal Start-->
                                                <button type="button" class="btn btn-sm btn-primary float-right"
                                                    data-bs-toggle="modal" data-bs-target="#NewAuthor"
                                                    style="padding: 0px 5px;">New
                                                    Author</button>
                                                <div class="modal fade" id="NewAuthor" tabindex="-1"
                                                    aria-labelledby="NewAuthorLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="NewAuthorLabel">New
                                                                    Author</h5>
                                                                <a href="#" data-dismiss="modal">
                                                                    <i class="fas fa-x" style="outline: none"></i>
                                                                </a>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- Your form field here -->
                                                                <form id="newAuthorForm">
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
                                                                <div id="processingMessage" style="display: none;">
                                                                    Processing...</div>
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="button" id="submitAuthor"
                                                                    class="btn btn-primary">Save</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal End-->
                                                <select id="author_id" name="author_id" class="form-control">

                                                </select>
                                                <div id="authorSuccessMessage"></div>
                                            </div>
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
                                            <div class="col">
                                                <label for="genre_name_primary" class="form-label">Genre</label>
                                                <!-- Modal Start-->
                                                <button type="button" class="btn btn-sm btn-primary float-right"
                                                    data-bs-toggle="modal" data-bs-target="#NewGenre"
                                                    style="padding: 0px 5px;">New
                                                    Genre</button>
                                                <div class="modal fade" id="NewGenre" tabindex="-1"
                                                    aria-labelledby="NewGenreLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="NewGenreLabel">Add New
                                                                    Genre</h5>
                                                                <a href="#" data-dismiss="modal">
                                                                    <i class="fas fa-x" style="outline: none"></i>
                                                                </a>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- Your form field here -->
                                                                <form id="modalForm">
                                                                    <div class="mb-3">
                                                                        <label for="genre_name" class="form-label">Genre
                                                                            Name</label>
                                                                        <input type="text" id="genre_name"
                                                                            name="genre_name" class="form-control">
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div id="processingMessage3" style="display: none;">
                                                                    Processing...</div>
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="button" id="submitGenre"
                                                                    class="btn btn-primary">Save</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal End-->

                                                <select id="genre_name_primary" name="genre_name_primary"
                                                    class="form-control">

                                                </select>
                                                <div id="genreSuccessMessage"></div>
                                            </div>
                                            <!--CREATE PUBLISHER SELECT FIELD-->
                                            <div class="col" id="publisher_col">
                                                <label for="publisher_name" class="form-label">Publisher</label>

                                                <!-- Modal Start -->
                                                <button type="button" class="btn btn-sm btn-primary float-right"
                                                    data-bs-toggle="modal" data-bs-target="#NewPublisher"
                                                    style="padding: 0px 5px;">New
                                                    Publisher</button>
                                                <div class="modal fade" id="NewPublisher" tabindex="-1"
                                                    aria-labelledby="NewPublisherLabel" aria-hidden="true">
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
                                                                        <label for="publisher_name"
                                                                            class="form-label">Publisher
                                                                            Name</label>
                                                                        <input type="text" id="new_publisher_name"
                                                                            name="publisher_name" class="form-control">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="publisher_country"
                                                                            class="form-label">Publisher
                                                                            Country</label>
                                                                        <input type="text" id="publisher_country"
                                                                            name="publisher_country"
                                                                            class="form-control">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="email_address"
                                                                            class="form-label">Email Address</label>
                                                                        <input type="email" id="email_address"
                                                                            name="email_address" class="form-control">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="phone_number"
                                                                            class="form-label">Phone Number</label>
                                                                        <input type="text" id="phone_number"
                                                                            name="phone_number" class="form-control">
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div id="processingMessage2" style="display: none;">
                                                                    Processing...</div>
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="button" id="submitPublisher"
                                                                    class="btn btn-primary">Save</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal End -->

                                                <select id="publisher_name" name="publisher_name" class="form-control">

                                                </select>
                                                <div id="publisherSuccessMessage"></div>
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
                                                    ?>
                                                    <label for="stock_quantity" class="form-label">Stock
                                                        Quantity</label>
                                                    <input type="number" id="stock_quantity" name="stock_quantity"
                                                        class="form-control" value="<?php echo $stock_quantity ?>"
                                                        readonly>

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
                                        <button type="button" id="submit-form"
                                            class="btn btn-primary text-nowrap mr-5">Save
                                            Changes</button>
                                    </div>
                                    <div class="col-1">
                                        <a href="inventory.php"><button type="button"
                                                class="btn btn-secondary">Cancel</button><a href="inventory.php">
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="row">
                                <div class="col">
                                    <h3 class="text-left mb-3">Copies</h3>
                                </div>
                                <div class="col">
                                    <a href="create_copy.php?book_isbn=<?php echo $book_isbn?>" class="float-right"><button type="button"
                                            class="btn btn-sm btn-primary float-end">Create New
                                            Copy</button></a>
                                </div>
                            </div>
                            <div class="table-responsive">
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
                                            echo "<tr><td >No Copies</td>";
                                            echo "<td ></td>";
                                            echo "<td ></td>";
                                            echo "<td ></td>";
                                            echo "<td ></td>";
                                            echo "<td ></td></tr>";
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/lib/jquery.nanoscroller.min.js"></script>
    <!-- nano scroller -->
    <script src="js/lib/menubar/sidebar.js"></script>
    <script src="js/lib/preloader/pace.min.js"></script>
    <!-- sidebar -->

    <script src="js/scripts.js"></script>
    <!-- bootstrap -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>


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
    <script>
        $(document).ready(function () {
            $("#submit-form").click(function () {
                var book_isbn = $("#book_isbn").val();
                var book_title = $("#book_title").val();
                var author_id = $("#author_id").val();
                var edition = $("#edition").val();
                var language = $("#language").val();
                var genre_name_primary = $("#genre_name_primary").val();
                var publisher_name = $("#publisher_name").val();
                var num_of_pages = $("#num_of_pages").val();
                var dataType = "Book"; // Define dataType for Book

                // Show processing message
                $("#processingMessage0").show();
                $("#successMessage0").hide();
                $.ajax({
                    type: "POST",
                    url: "edit_book_processor.php",
                    data: {
                        book_isbn: book_isbn,
                        book_title: book_title,
                        author_id: author_id,
                        edition: edition,
                        language: language,
                        genre_name_primary: genre_name_primary,
                        publisher_name: publisher_name,
                        num_of_pages: num_of_pages,

                    },
                    success: function (data) {
                        //hide processing messag
                        $("#processingMessage0").hide();
                        $("#successMessage0").show();
                    },
                    error: function (xhr, status, error) {
                        console.log("Error: " + errorThrown);
                        $("#processingMessage0").hide();
                        $("#failureMessage0").show();
                    }
                });
            });
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



            function updateAuthorSelect() {
                $("#author_id").load("get_basic_select_options.php?author_id=<?php echo $author_id ?>");
            }

            updateAuthorSelect();

            function updateGenreSelect() {
                $("#genre_name_primary").load("get_basic_select_options.php?genre_id=<?php echo $genre_id ?>");
            }

            updateGenreSelect();

            function updatePublisherSelect() {
                $("#publisher_name").load("get_basic_select_options.php?publisher_id=<?php echo $publisher_id ?>");
            }

            updatePublisherSelect();

            $("#submitAuthor").click(function () {
                var author_first_name = $("#author_first_name").val();
                var author_last_name = $("#author_last_name").val();
                var dataType = "Author"; // Define dataType for Author

                // Show processing message
                $("#processingMessage").show();


                $.ajax({
                    type: "POST",
                    url: "insert_data_new_author.php",
                    data: {
                        author_first_name: author_first_name,
                        author_last_name: author_last_name,
                        dataType: dataType // Pass dataType parameter
                    },
                    success: function (data) {
                        // Hide processing message
                        $("#processingMessage").hide();
                        // Hide the current modal
                        $("#NewAuthor").modal('hide');
                        displaySuccessModal(dataType);

                        // Call the function to update the author options
                        updateAuthorSelect();
                        $("#authorSuccessMessage").html("New Genre added successfully!");

                        //reset the form
                        $("#newAuthorForm")[0].reset();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log("Error: " + errorThrown);
                    }
                });
            });

            $("#submitGenre").click(function () {
                var genre_name = $("#genre_name").val();
                var dataType = "Genre"; // Define dataType for Genre

                // Show processing message
                $("#processingMessage3").show();
                $.ajax({
                    type: "POST",
                    url: "insert_data_new_genre.php",
                    data: {
                        genre_name: genre_name
                    },
                    success: function (data) {
                        //hide processing message
                        $("#processingMessage3").hide();
                        // Update the modal or display a success message
                        $("#NewGenre").modal('hide'); // Close the modal
                        displaySuccessModal(dataType);
                        updateGenreSelect();
                        $("#genreSuccessMessage").html("New Genre added successfully!");
                    },
                    error: function (xhr, status, error) {
                        console.log("Error: " + errorThrown);
                    }
                });
            });

            $("#submitPublisher").click(function () {
                var publisher_name = $("#new_publisher_name").val();
                var publisher_country = $("#publisher_country").val();
                var email_address = $("#email_address").val();
                var phone_number = $("#phone_number").val()
                var dataType = "Publisher"; // Define dataType for Publisher

                // Show processing message
                $("#processingMessage2").show();

                $.ajax({
                    type: "POST",
                    url: "insert_data_new_publisher.php",
                    data: {
                        publisher_name: publisher_name,
                        publisher_country: publisher_country,
                        email_address: email_address,
                        phone_number: phone_number,
                        dataType: dataType // Pass dataType parameter
                    },
                    success: function (data) {
                        // Hide processing message
                        $("#processingMessage2").hide();
                        // Hide the current modal
                        $("#NewPublisher").modal('hide');
                        displaySuccessModal(dataType);
                        updatePublisherSelect(); // Call the function to update the publisher options
                        // Optionally, you can reset the form
                        $("#newPublisherForm")[0].reset();
                        $("#publisherSuccessMessage").html("New Genre added successfully!");
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log("Error: " + errorThrown);
                    }
                });
            });

            // Function to display the success modal
            function displaySuccessModal(dataType) {
                $("#successMessage").html(dataType + " Added Successfully"); // Set the success message
                $("#successModal").modal("show");
            }



        });




    </script>

</body>

</html>