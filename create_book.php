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
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <form method="post" action="insert_data_new_book.php">

                                    <div class="mb-3">
                                        <div class="row mb-3">
                                            <div class="col-4">
                                                <label for="book_isbn" class="form-label">Book ISBN</label>
                                                <input type="number" id="book_isbn" name="book_isbn" class="form-control">
                                            </div>
                                            <div class="col-4">
                                                <label for="book_title" class="form-label">Title</label>
                                                <input type="text" id="book_title" name="book_title" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="row mb-3">

                                                <div class="col-4">
                                                    <label for="edition" class="form-label">Edition</label>
                                                    <input type="number" id="edition" name="edition" class="form-control">
                                                </div>
                                                <div class="col">
                                                    <label for="author_first_name" class="form-label">Author
                                                        Name</label>

                                                    <!-- Modal Start-->
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#NewAuthor" style="padding: 0px 5px;">New
                                                        Author</button>
                                                    <div class="modal fade" id="NewAuthor" tabindex="-1" aria-labelledby="NewAuthorLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="NewAuthorLabel">New
                                                                        Author</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <!-- Your form field here -->
                                                                    <form id="newAuthorForm">
                                                                        <div class="mb-3">
                                                                            <label for="author_first_name" class="form-label">Author First
                                                                                Name</label>
                                                                            <input type="text" id="author_first_name" name="author_first_name" class="form-control">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="author_last_name" class="form-label">Author Last
                                                                                Name</label>
                                                                            <input type="text" id="author_last_name" name="author_last_name" class="form-control">
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <div id="processingMessage" style="display: none;">Processing...</div>
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="button" id="submitAuthor" class="btn btn-primary">Save</button>
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

                                                <div class="col">
                                                    <label for="publisher_name" class="form-label">Publisher</label>

                                                    <!-- Modal Start -->
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#NewPublisher" style="padding: 0px 5px;">New Publisher</button>
                                                    <div class="modal fade" id="NewPublisher" tabindex="-1" aria-labelledby="NewPublisherLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="NewPublisherLabel">New Publisher</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <!-- Your form field here -->
                                                                    <form id="newPublisherForm" method="post">
                                                                        <div class="mb-3">
                                                                            <label for="publisher_name" class="form-label">Publisher Name</label>
                                                                            <input type="text" id="new_publisher_name" name="publisher_name" class="form-control">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="publisher_country" class="form-label">Publisher Country</label>
                                                                            <input type="text" id="publisher_country" name="publisher_country" class="form-control">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="email_address" class="form-label">Email Address</label>
                                                                            <input type="email" id="email_address" name="email_address" class="form-control">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="phone_number" class="form-label">Phone Number</label>
                                                                            <input type="text" id="phone_number" name="phone_number" class="form-control">
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <div id="processingMessage2" style="display: none;">Processing...</div>
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="button" id="submitPublisher" class="btn btn-primary">Save</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Modal End -->

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
                                                <div class="col-4">
                                                    <label for="num_of_pages" class="form-label">Number of
                                                        Pages</label>
                                                    <input type="number" id="num_of_pages" name="num_of_pages" class="form-control">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-1">
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </div>
                                            <div class="col-1">
                                                <a href="inventory.php"><button type="button" class="btn btn-secondary">Close</button></a>
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





    <!-- Success Modal  -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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





    <script>
        $(document).ready(function() {
            $("#submitAuthor").click(function() {
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
                    success: function(data) {
                        // Hide processing message
                        $("#processingMessage").hide();
                        // Hide the current modal
                        $("#NewAuthor").modal('hide');
                        displaySuccessModal(dataType);

                        // Call the function to update the author options
                        updateAuthorOptions();

                        //reset the form
                        $("#newAuthorForm")[0].reset();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log("Error: " + errorThrown);
                    }
                });
            });

            $("#submitPublisher").click(function() {
                var publisher_name = $("#new_publisher_name").val();
                var dataType = "Publisher"; // Define dataType for Publisher

                // Show processing message
                $("#processingMessage2").show();

                $.ajax({
                    type: "POST",
                    url: "insert_data_new_publisher.php",
                    data: {
                        publisher_name: publisher_name,
                        dataType: dataType // Pass dataType parameter
                    },
                    success: function(data) {
                        // Hide processing message
                        $("#processingMessage2").hide();
                        // Hide the current modal
                        $("#NewPublisher").modal('hide');
                        displaySuccessModal(dataType);
                        updatePublisherOptions(); // Call the function to update the publisher options
                        // Optionally, you can reset the form
                        $("#newPublisherForm")[0].reset();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log("Error: " + errorThrown);
                    }
                });
            });

            // Function to display the success modal
            function displaySuccessModal(dataType) {
                $("#successMessage").html(dataType + " Added Successfully"); // Set the success message
                $("#successModal").modal("show");
            }

            //Author Options Update



            function updateAuthorOptions() {
                console.log("Making AJAX request to get_author_list.php");
                $.ajax({
                    type: "GET",
                    url: "get_author_list.php", // PHP script to fetch the updated list of authors
                    success: function(data) {
                        console.log(data); // Log the response data to the console
                        // Replace the options in the select element with the updated data
                        $("#author_name").html(data);
                    }
                });
            }



            //Publisher Options Update 

            function updatePublisherOptions() {
                console.log("Making AJAX request to get_publisher_list.php");
                $.ajax({
                    type: "GET",
                    url: "get_publisher_list.php", // PHP script to fetch the updated list of publishers
                    success: function(data) {
                        console.log(data); // Log the response data to the console
                        // Replace the options in the select element with the updated data
                        $("#publisher_name").html(data);
                    }
                });
            }
        })
    </script>




</body>

</html>